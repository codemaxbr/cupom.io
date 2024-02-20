<?php

namespace App\Observers;

use App\Events\LogActivity;
use App\Models\TypeAddress;
use Illuminate\Support\Facades\Auth;

class TypeAddressObserver
{
    /**
     * Handle the type address "created" event.
     *
     * @param  \App\Models\TypeAddress  $typeAddress
     * @return void
     */
    public function created(TypeAddress $typeAddress)
    {
        event(new LogActivity($typeAddress, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the type address "updated" event.
     *
     * @param  \App\Models\TypeAddress  $typeAddress
     * @return void
     */
    public function updated(TypeAddress $typeAddress)
    {
        event(new LogActivity($typeAddress, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the type address "deleted" event.
     *
     * @param  \App\Models\TypeAddress  $typeAddress
     * @return void
     */
    public function deleted(TypeAddress $typeAddress)
    {
        event(new LogActivity($typeAddress, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the type address "restored" event.
     *
     * @param  \App\Models\TypeAddress  $typeAddress
     * @return void
     */
    public function restored(TypeAddress $typeAddress)
    {
        event(new LogActivity($typeAddress, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the type address "force deleted" event.
     *
     * @param  \App\Models\TypeAddress  $typeAddress
     * @return void
     */
    public function forceDeleted(TypeAddress $typeAddress)
    {
        event(new LogActivity($typeAddress, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }
}
