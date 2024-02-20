<?php

namespace App\Http\Controllers;

use App\Events\ActiveSubscription;
use App\Events\AlterPlanSubscription;
use App\Events\SuspendSubscription;
use App\Jobs\TerminateAccount;
use App\Models\Cancellation;
use App\Models\Plan;
use App\Models\Subscription;
use App\Services\CancellationService;
use App\Services\CustomerService;
use App\Services\PlanService;
use App\Services\SubscriptionService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    /**
     * @var SubscriptionService
     */
    private $subscriptionService;
    private $customerService;
    private $cancellationService;
    /**
     * @var PlanService
     */
    private $planService;

    /**
     * SubscriptionController constructor.
     */
    public function __construct(SubscriptionService $subscriptionService, CustomerService $customerService, CancellationService $cancellationService, PlanService $planService)
    {
        $this->subscriptionService = $subscriptionService;
        $this->customerService = $customerService;
        $this->cancellationService = $cancellationService;
        $this->planService = $planService;
    }

    public function index()
    {
        $plans = $this->planService->getAll();
        $sub = $this->subscriptionService->getSubscriptions(20);

        return view('customers.subscriptions.index')->with([
            'assinaturas' => $sub,
            'plans'         =>  $plans
        ]);
    }

    public function searchSimples(Request $request)
    {
        $input = (object) $request->all();
        $status = '1';
        $plans = $this->planService->getAll();

        $subscriptions = $this->subscriptionService->searchSimples($input->busca, $status);

        return view('customers.subscriptions.index')->with([
            'assinaturas'   =>  $subscriptions,
            'plans'         =>  $plans
        ]);
    }

    public function searchAdvanced(Request $request)
    {
        $input = (object) $request->all();
        $status = '1';
        $sub = $this->subscriptionService->getAllSubscriptionsStatus($status);
        $plans = $this->planService->allPlans();


        $busca = [
            'plan_id'   => (isset($input->plan_id))? $input->plan_id : null,
            'cycle_id'  => (isset($input->cycle_id))? $input->cycle_id : null
        ];

        $user = Auth::user();

        $subscriptions = $this->subscriptionService->searchAdvanced($busca, $user->account_id);
        if(!is_Null($subscriptions)) $subscriptions->appends(request()->query());

        if(!is_Null($subscriptions))
        {
            return view('customers.subscriptions.index')->with([
                'assinaturas'   =>   $sub,
                'plans'         =>  $plans
            ]);
        }

        dd($subscriptions);
    }

    public function view($subscription_id)
    {
        $this->subscriptionService->setId($subscription_id);
        $subscription = $this->subscriptionService->getSubscription();
        $plans = $this->planService->getAll();

        return view('customers.subscriptions.show')->with([
            'assinatura'        => $subscription,
            'plans'             =>  $plans
        ]);
    }

    public function cortesia()
    {
        $status = 2;
        $subscription = $this->subscriptionService->getAllSubscriptionsStatus($status);

    }

    public function cancelView()
    {
        $status = '0';
        $sub = $this->subscriptionService->getAllSubscriptionsStatus($status);
        //dd($sub);
        return view('customers.cancellations.index')->with([
            'assinaturas' => $sub
        ]);
    }

    public function cancelSub($id, Request $request)
    {
        $dados = array(
            'status' => 0
        );

        $req = $request->except(['_token', '_method']);
        $this->subscriptionService->setId($id);
        $subscription = $this->subscriptionService->getSubscription();

        //Atualiza o status da assinatura
        $sub = $this->subscriptionService->update($id,$dados);

        //Deletar a assinatura
        //$sub = $this->subscriptionService->remove($id);

        $dadosCancellation = array(
            'customer_id'   =>  $subscription->customer_id,
            'plan_id'       =>  $subscription->plan_id,
            'total'         =>  $subscription->plan->price,
            'domain'        =>  null,
            'activated_at'  =>  $subscription->activated_at,
            'cancelled_at'  =>  Carbon::now(),
            'reason'        =>  $req['reason'],
            'user_id'       =>  Auth::user()->id,
            'account_id'    =>  $subscription->account_id
        );

        $cancel = $this->cancellationService->create($dadosCancellation);

        return redirect()->route('subscriptions.view', $subscription->id)->with('success'.'A assinatura'. $subscription->id .'foi cancelada com sucesso!');

    }

    public function updatePlan(Subscription $subscription, Request $request)
    {
        $update = null;
        $update_value = null;

        foreach ($request->except(['_token', '_method']) as $key => $item){
            $subscription->$key = $item;
            $update = $key;
            $update_value = $item;
        }

        if($update == 'status')
        {
            switch ($update_value)
            {
                case 1:
                    event(new ActiveSubscription($subscription));

                    $subscription->save();
                    return redirect()->route('subscriptions.view', $subscription->id)->with('success','A assinatura #'.$subscription->id.' foi ATIVADA com sucesso!');
                break;
                case 0:
                    event(new SuspendSubscription($subscription));

                    $subscription->save();
                    return redirect()->route('subscriptions.view', $subscription->id)->with('success','A assinatura #'.$subscription->id.' foi SUSPENSA com sucesso!');
                break;
            }
        }

        if($update == 'plan_id')
        {
            $plan = Plan::find($update_value);
            event(new AlterPlanSubscription($subscription, $plan));
            $subscription->total = $plan->price;

            $subscription->save();
            return redirect()->route('subscriptions.view', $subscription->id)->with('success','A assinatura #'.$subscription->id.' foi alterada o plano para: '.$plan->name.'!');
        }

        $subscription->save();
        return redirect()->route('subscriptions.view', $subscription->id)->with('success','A assinatura #'.$subscription->id.' foi alterada com sucesso!');
    }

    public function updateDue(Subscription $subscription, Request $request)
    {
        $subscription->due = Carbon::parse(dateEUA($request->due));
        $subscription->save();

        return redirect()->route('subscriptions.view', $subscription->id)->with('success', 'A data de vencimento da assinatura nº '.$subscription->id.' foi alterada para ('.$request->due.').');
    }

    public function cancelSubscription(Subscription $subscription, Request $request)
    {
        $dados = array(
            'status' => 1,
            'cancelled' =>  1,
            'comment' => $request->reason
        );

        $subscription->update($dados);

        return redirect()->route('subscriptions.view', $subscription->id)->with('success','A assinatura'. $subscription->id .'foi cancelada com sucesso!');
    }

    public function cancelSubscriptionImmediate(Subscription $subscription, Request $request)
    {
        $cancellation = Cancellation::create([
            'customer_id' => $subscription->customer_id,
            'plan_id' => $subscription->plan_id,
            'total' => $subscription->total,
            'domain' => $subscription->domain,
            'activated_at' => $subscription->activated_at,
            'cancelled_at' => Carbon::now(),
            'reason' => $request->reason,
            'user_id' => Auth::user()->id,
            'account_id' => Auth::user()->account_id
        ]);

        $dados = array(
            'status' => 1,
            'cancelled' =>  1,
            'comment' => $request->reason
        );

        $subscription->update($dados);

        $plan = $subscription->plan;
        $module = $subscription->plan->module;
        $server = $plan->server;
        $subscription_id = $subscription->id;

        if($module != null && $module->type_module_id == 2){

            TerminateAccount::dispatch($plan, $server, $subscription);
            return redirect()->route('subscriptions.index')->with('success','A assinatura #'. $subscription_id .'foi cancelada com sucesso!');
        }
    }


}
