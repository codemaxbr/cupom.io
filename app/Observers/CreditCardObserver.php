<?php

namespace App\Observers;

use App\Events\LogActivity;
use App\Models\CreditCard;
use Illuminate\Support\Facades\Auth;

class CreditCardObserver
{
    /**
     * Handle the credit card "created" event.
     *
     * @param  \App\Models\CreditCard  $creditCard
     * @return void
     */
    public function created(CreditCard $creditCard)
    {
        event(new LogActivity($creditCard, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the credit card "updated" event.
     *
     * @param  \App\Models\CreditCard  $creditCard
     * @return void
     */
    public function updated(CreditCard $creditCard)
    {
        event(new LogActivity($creditCard, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the credit card "deleted" event.
     *
     * @param  \App\Models\CreditCard  $creditCard
     * @return void
     */
    public function deleted(CreditCard $creditCard)
    {
        event(new LogActivity($creditCard, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the credit card "restored" event.
     *
     * @param  \App\Models\CreditCard  $creditCard
     * @return void
     */
    public function restored(CreditCard $creditCard)
    {
        event(new LogActivity($creditCard, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the credit card "force deleted" event.
     *
     * @param  \App\Models\CreditCard  $creditCard
     * @return void
     */
    public function forceDeleted(CreditCard $creditCard)
    {
        event(new LogActivity($creditCard, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }
}
