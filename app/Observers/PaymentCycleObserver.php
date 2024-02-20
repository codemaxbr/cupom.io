<?php

namespace App\Observers;

use App\Events\LogActivity;
use App\Models\PaymentCycle;
use Illuminate\Support\Facades\Auth;

class PaymentCycleObserver
{
    /**
     * Handle the payment cycle "created" event.
     *
     * @param  \App\Models\PaymentCycle  $paymentCycle
     * @return void
     */
    public function created(PaymentCycle $paymentCycle)
    {
        event(new LogActivity($paymentCycle, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the payment cycle "updated" event.
     *
     * @param  \App\Models\PaymentCycle  $paymentCycle
     * @return void
     */
    public function updated(PaymentCycle $paymentCycle)
    {
        event(new LogActivity($paymentCycle, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the payment cycle "deleted" event.
     *
     * @param  \App\Models\PaymentCycle  $paymentCycle
     * @return void
     */
    public function deleted(PaymentCycle $paymentCycle)
    {
        event(new LogActivity($paymentCycle, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the payment cycle "restored" event.
     *
     * @param  \App\Models\PaymentCycle  $paymentCycle
     * @return void
     */
    public function restored(PaymentCycle $paymentCycle)
    {
        event(new LogActivity($paymentCycle, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the payment cycle "force deleted" event.
     *
     * @param  \App\Models\PaymentCycle  $paymentCycle
     * @return void
     */
    public function forceDeleted(PaymentCycle $paymentCycle)
    {
        event(new LogActivity($paymentCycle, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }
}
