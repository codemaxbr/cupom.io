<?php

namespace App\Listeners;

use App\Events\AlterPlanSubscription;
use App\Models\Plan;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AlterPlan
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(AlterPlanSubscription $event)
    {
        $subscription = $event->subscription;
        $new_plan     = $event->plan;
        $current_plan = Plan::find($subscription->getOriginal('plan_id'));
        $plugin       = $current_plan->module;

        /**
         * Se o plano assinado, for ligado à um módulo de integração...
         */
        if(!is_null($plugin) && $plugin->type_module_id == 2)
        {
            \App\Jobs\AlterPlan::dispatch($subscription, $plugin, $new_plan);
        }else{
            dd('Vejo daqui a pouco');
        }
    }
}
