<?php
/**
 * Created by PhpStorm.
 * User: Lucas e Nathalia
 * Date: 11/08/2018
 * Time: 16:30
 */

namespace App\Services;


use App\Models\Subscription;
use App\Repositories\SubscriptionRepository;
use Illuminate\Support\Facades\DB;

class SubscriptionService
{
    /**
     * @var SubscriptionRepository
     */
    private $subscriptionRepository;
    private $subscription_id;
    private $accountId;

    /**
     * SubscriptionService constructor.
     */
    public function __construct(SubscriptionRepository $subscriptionRepository)
    {
        $this->subscriptionRepository = $subscriptionRepository;
    }

    /**
     * Lista todos os registros
     * @return array
     */
    public function getSubscriptions($paginate = null)
    {
        $result = $this->subscriptionRepository->orderBy('id', 'desc')
            ->with(['customer:id,name', 'plan:id,uuid,name,payment_cycle_id', 'plan.payment_cycle:id,name'])
            ->whereHas('account', function ($q){
                $q->where('id', AccountId());

            });

        if(!is_null($paginate)){
            return $result->paginate($paginate);
        }else{
            return $result->all();
        }
    }

    public function searchSimples($search, $status)
    {
        $subscriptions = Subscription::with('customer')->where('status', $status)->orderBy('id', 'desc')->whereHas('customer', function ($query) use ($search){
            $query->where('name', 'LIKE', "%{$search}%");
        })->paginate(20);

        return $subscriptions;
    }

    public function searchAdvanced($search, $account)
    {
        $subscriptions = Subscription::query();
        if($search['plan_id'] != null)
        {
            $subscriptions->where('plan_id', $search['plan_id']);
        }

        if($search['cycle_id'] !=null)
        {
            $subscriptions->with('plan')->whereHas('plan', function ($query) use($search){
                $query->where('payment_cycle_id', '=', $search['cycle_id']);
            });
        }

        if($account['id'] !=null)
        {
            $subscriptions->where('account_id', $account['id']);
        }



        return  ($subscriptions->paginate(20)->total() != 0) ? $subscriptions->paginate(20) : null;


    }

    /*public function searchAdvanced($account, $search)
    {
        $this->accountId = $account;
        $subscriptions = Subscription::with('account')
            ->whereHas('account', function ($q){
                $q->where('id', $this->accountId);
        });
        if($search['plan'] != null){
            $subscriptions->where('plan', $search['plan']);
        }

    }*/

    public function find($id)
    {
        return $this->subscriptionRepository->find($id);
    }

    public function update($id, $dados)
    {
        return Subscription::query()->where('id', $id)->update($dados);
    }

    public function remove($id)
    {
        return Subscription::query()->where('id', $id)->delete();
    }

    public function getAllSubscriptionsStatus($status)
    {
        return Subscription::query()
            ->where('status', $status)
            ->orderBy('id', 'desc')
            ->paginate(20);
    }

    public function findExists($customer_id, $plan_id, $domain = null)
    {
        return $this->subscriptionRepository->findWhere(['customer_id' => $customer_id, 'plan_id' => $plan_id, 'domain' => $domain]);
    }

    public function setId($subscription_id)
    {
        $this->subscription_id = $subscription_id;
    }

    public function getSubscription()
    {
        return $this->subscriptionRepository->with(['customer', 'plan', 'plan.payment_cycle', 'invoices', 'type_payment'])->find($this->subscription_id);
    }

    public function newSubscription($data)
    {
        return $this->subscriptionRepository->create($data);
    }




}