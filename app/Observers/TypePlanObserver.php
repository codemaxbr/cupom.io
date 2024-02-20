<?php

namespace App\Observers;

use App\Events\LogActivity;
use App\Models\TypePlan;
use Illuminate\Support\Facades\Auth;

class TypePlanObserver
{
    /**
     * Handle the type plan "created" event.
     *
     * @param  \App\Models\TypePlan  $typePlan
     * @return void
     */
    public function created(TypePlan $typePlan)
    {
        event(new LogActivity($typePlan, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the type plan "updated" event.
     *
     * @param  \App\Models\TypePlan  $typePlan
     * @return void
     */
    public function updated(TypePlan $typePlan)
    {
        event(new LogActivity($typePlan, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the type plan "deleted" event.
     *
     * @param  \App\Models\TypePlan  $typePlan
     * @return void
     */
    public function deleted(TypePlan $typePlan)
    {
        event(new LogActivity($typePlan, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the type plan "restored" event.
     *
     * @param  \App\Models\TypePlan  $typePlan
     * @return void
     */
    public function restored(TypePlan $typePlan)
    {
        event(new LogActivity($typePlan, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the type plan "force deleted" event.
     *
     * @param  \App\Models\TypePlan  $typePlan
     * @return void
     */
    public function forceDeleted(TypePlan $typePlan)
    {
        event(new LogActivity($typePlan, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }
}
