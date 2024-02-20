<?php

namespace App\Observers;

use App\Events\LogActivity;
use App\Models\Plan;
use Illuminate\Support\Facades\Auth;

class PlanObserver
{
    /**
     * Handle the plan "created" event.
     *
     * @param  \App\Models\Plan  $plan
     * @return void
     */
    public function created(Plan $plan)
    {
        event(new LogActivity($plan, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the plan "updated" event.
     *
     * @param  \App\Models\Plan  $plan
     * @return void
     */
    public function updated(Plan $plan)
    {
        event(new LogActivity($plan, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the plan "deleted" event.
     *
     * @param  \App\Models\Plan  $plan
     * @return void
     */
    public function deleted(Plan $plan)
    {
        event(new LogActivity($plan, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the plan "restored" event.
     *
     * @param  \App\Models\Plan  $plan
     * @return void
     */
    public function restored(Plan $plan)
    {
        event(new LogActivity($plan, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the plan "force deleted" event.
     *
     * @param  \App\Models\Plan  $plan
     * @return void
     */
    public function forceDeleted(Plan $plan)
    {
        event(new LogActivity($plan, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }
}
