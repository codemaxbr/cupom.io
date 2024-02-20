<?php

namespace App\Observers;

use App\Events\LogActivity;
use App\Models\SubscriptionsInvoice;
use Illuminate\Support\Facades\Auth;

class SubscriptionsInvoiceObserver
{
    /**
     * Handle the subscriptions invoice "created" event.
     *
     * @param  \App\Models\SubscriptionsInvoice  $subscriptionsInvoice
     * @return void
     */
    public function created(SubscriptionsInvoice $subscriptionsInvoice)
    {
        event(new LogActivity($subscriptionsInvoice, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the subscriptions invoice "updated" event.
     *
     * @param  \App\Models\SubscriptionsInvoice  $subscriptionsInvoice
     * @return void
     */
    public function updated(SubscriptionsInvoice $subscriptionsInvoice)
    {
        event(new LogActivity($subscriptionsInvoice, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the subscriptions invoice "deleted" event.
     *
     * @param  \App\Models\SubscriptionsInvoice  $subscriptionsInvoice
     * @return void
     */
    public function deleted(SubscriptionsInvoice $subscriptionsInvoice)
    {
        event(new LogActivity($subscriptionsInvoice, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the subscriptions invoice "restored" event.
     *
     * @param  \App\Models\SubscriptionsInvoice  $subscriptionsInvoice
     * @return void
     */
    public function restored(SubscriptionsInvoice $subscriptionsInvoice)
    {
        event(new LogActivity($subscriptionsInvoice, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the subscriptions invoice "force deleted" event.
     *
     * @param  \App\Models\SubscriptionsInvoice  $subscriptionsInvoice
     * @return void
     */
    public function forceDeleted(SubscriptionsInvoice $subscriptionsInvoice)
    {
        event(new LogActivity($subscriptionsInvoice, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }
}
