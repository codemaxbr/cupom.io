<?php

namespace App\Observers;

use App\Events\LogActivity;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;

class SubscriptionObserver
{
    /**
     * Handle the subscription "created" event.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return void
     */
    public function created(Subscription $subscription)
    {
        event(new LogActivity($subscription, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the subscription "updated" event.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return void
     */
    public function updated(Subscription $subscription)
    {
        event(new LogActivity($subscription, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the subscription "deleted" event.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return void
     */
    public function deleted(Subscription $subscription)
    {
        event(new LogActivity($subscription, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the subscription "restored" event.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return void
     */
    public function restored(Subscription $subscription)
    {
        event(new LogActivity($subscription, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the subscription "force deleted" event.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return void
     */
    public function forceDeleted(Subscription $subscription)
    {
        event(new LogActivity($subscription, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }
}
