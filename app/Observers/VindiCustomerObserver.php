<?php

namespace App\Observers;

use App\Events\LogActivity;
use App\Models\VindiCustomer;
use Illuminate\Support\Facades\Auth;

class VindiCustomerObserver
{
    /**
     * Handle the vindi customer "created" event.
     *
     * @param  \App\Models\VindiCustomer  $vindiCustomer
     * @return void
     */
    public function created(VindiCustomer $vindiCustomer)
    {
        event(new LogActivity($vindiCustomer, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the vindi customer "updated" event.
     *
     * @param  \App\Models\VindiCustomer  $vindiCustomer
     * @return void
     */
    public function updated(VindiCustomer $vindiCustomer)
    {
        event(new LogActivity($vindiCustomer, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the vindi customer "deleted" event.
     *
     * @param  \App\Models\VindiCustomer  $vindiCustomer
     * @return void
     */
    public function deleted(VindiCustomer $vindiCustomer)
    {
        event(new LogActivity($vindiCustomer, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the vindi customer "restored" event.
     *
     * @param  \App\Models\VindiCustomer  $vindiCustomer
     * @return void
     */
    public function restored(VindiCustomer $vindiCustomer)
    {
        event(new LogActivity($vindiCustomer, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the vindi customer "force deleted" event.
     *
     * @param  \App\Models\VindiCustomer  $vindiCustomer
     * @return void
     */
    public function forceDeleted(VindiCustomer $vindiCustomer)
    {
        event(new LogActivity($vindiCustomer, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }
}
