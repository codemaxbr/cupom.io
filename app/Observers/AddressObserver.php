<?php

namespace App\Observers;

use App\Events\LogActivity;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;

class AddressObserver
{
    /**
     * Handle the address "created" event.
     *
     * @param  \App\Models\Address  $address
     * @return void
     */
    public function created(Address $address)
    {
        event(new LogActivity($address, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the address "updated" event.
     *
     * @param  \App\Models\Address  $address
     * @return void
     */
    public function updated(Address $address)
    {
        event(new LogActivity($address, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the address "deleted" event.
     *
     * @param  \App\Models\Address  $address
     * @return void
     */
    public function deleted(Address $address)
    {
        event(new LogActivity($address, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the address "restored" event.
     *
     * @param  \App\Models\Address  $address
     * @return void
     */
    public function restored(Address $address)
    {
        event(new LogActivity($address, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the address "force deleted" event.
     *
     * @param  \App\Models\Address  $address
     * @return void
     */
    public function forceDeleted(Address $address)
    {
        event(new LogActivity($address, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }
}
