<?php

namespace App\Listeners;

use App\Jobs\SuspendAccount;
use App\Services\SubscriptionService;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SuspendSubscription
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
        $subscription = $event->subscription;
        $plugin = $subscription->plan->module;

        /**
         * Se o plano assinado, for ligado à um módulo de integração...
         */
        if(!is_null($plugin) && $plugin->type_module_id == 2)
        {
            SuspendAccount::dispatch($subscription, $plugin);
        }else{
            dd('Vejo daqui a pouco');
        }
    }
}
