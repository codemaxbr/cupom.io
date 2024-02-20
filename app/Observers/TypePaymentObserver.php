<?php

namespace App\Observers;

use App\Events\LogActivity;
use App\Models\TypePayment;
use Illuminate\Support\Facades\Auth;

class TypePaymentObserver
{
    /**
     * Handle the type payment "created" event.
     *
     * @param  \App\Models\TypePayment  $typePayment
     * @return void
     */
    public function created(TypePayment $typePayment)
    {
        event(new LogActivity($typePayment, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the type payment "updated" event.
     *
     * @param  \App\Models\TypePayment  $typePayment
     * @return void
     */
    public function updated(TypePayment $typePayment)
    {
        event(new LogActivity($typePayment, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the type payment "deleted" event.
     *
     * @param  \App\Models\TypePayment  $typePayment
     * @return void
     */
    public function deleted(TypePayment $typePayment)
    {
        event(new LogActivity($typePayment, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the type payment "restored" event.
     *
     * @param  \App\Models\TypePayment  $typePayment
     * @return void
     */
    public function restored(TypePayment $typePayment)
    {
        event(new LogActivity($typePayment, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the type payment "force deleted" event.
     *
     * @param  \App\Models\TypePayment  $typePayment
     * @return void
     */
    public function forceDeleted(TypePayment $typePayment)
    {
        event(new LogActivity($typePayment, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }
}
