<?php

namespace App\Listeners;

use App\Events\ConfirmPayment;
use App\Jobs\ActiveAccount;
use App\Jobs\CreateAccount;
use App\Services\SubscriptionService;
use Carbon\Carbon;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ActivateSubscription
{
    /**
     * @var SubscriptionService
     */
    private $subscriptionService;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(SubscriptionService $subscriptionService)
    {
        $this->subscriptionService = $subscriptionService;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $user = @$event->user;
        $invoice = @$event->invoice;
        $request = @$event->request;
        $subscription = @$event->subscription;

        /**
         * Se o evento for "ConfirmPayment"
         */
        if($invoice != null){

            // Se a Fatura for do tipo PEDIDO...
            if($invoice->type_invoice->name == 'Pedido' && $invoice->status != 1)
            {
                foreach($invoice->invoice_items as $item)
                {
                    $subscription = $this->subscriptionService->findExists($invoice->customer_id, $item->plan_id);

                    // Se o cliente não tiver nenhuma assinatura ativa (para o plano selecionado)
                    if($subscription->isEmpty())
                    {
                        $plan = $item->plan;
                        $plugin = $plan->module;
                        $server = $plan->server;
                        $months = $plan->payment_cycle->months;

                        CreateAccount::dispatch($plan, $item);

                        /**
                         * Se o cliente não tiver uma assinatura ativa (plano / dominio)
                         */
                        $new_subscription = $this->subscriptionService->newSubscription([
                            'customer_id'   => $invoice->customer_id,
                            'plan_id'       => $item->plan_id,
                            'domain'        => $item->domain,
                            'due'           => Carbon::now()->addMonths($months),
                            'activated_at'  => Carbon::now(),
                            'total'         => $plan->price,
                            'recurrence'    => ($plan->type_term_id == 1) ? true : false,
                            'status'        => 1,
                            'type_payment_id' => $request->type_payment,
                            'account_id'    => $plan->account_id,
                        ]);

                    }else{

                        dump('O cliente está tentando assinar o mesmo plano');
                        dd('Desbloqueia o serviço, se estiver bloqueado');
                    }
                }
            }

            if($invoice->type_invoice->name == 'Recorrência' && $invoice->status != 1)
            {
                foreach($invoice->invoice_items as $item) {
                    $subscription = $this->subscriptionService->findExists($invoice->customer_id, $item->plan_id);
                    dd($subscription);
                }
            }
        }

        /**
         * Se o evento for "ActiveSubscription"
         */

        if($subscription != null && isset($subscription->plan)){
            $plugin = $subscription->plan->module;

            /**
             * Se o plano assinado, for ligado à um módulo de integração...
             */
            if(!is_null($plugin) && $plugin->type_module_id == 2)
            {
                ActiveAccount::dispatch($subscription, $plugin);
            }else{
                dd('Vejo daqui a pouco');
            }
        }


    }
}
