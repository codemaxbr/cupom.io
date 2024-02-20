<?php

namespace App\Observers;

use App\Events\LogActivity;
use App\Models\Debit;
use Illuminate\Support\Facades\Auth;

class DebitObserver
{
    /**
     * Handle the debit "created" event.
     *
     * @param  \App\Models\Debit  $debit
     * @return void
     */
    public function created(Debit $debit)
    {
        event(new LogActivity($debit, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the debit "updated" event.
     *
     * @param  \App\Models\Debit  $debit
     * @return void
     */
    public function updated(Debit $debit)
    {
        event(new LogActivity($debit, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the debit "deleted" event.
     *
     * @param  \App\Models\Debit  $debit
     * @return void
     */
    public function deleted(Debit $debit)
    {
        event(new LogActivity($debit, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the debit "restored" event.
     *
     * @param  \App\Models\Debit  $debit
     * @return void
     */
    public function restored(Debit $debit)
    {
        event(new LogActivity($debit, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the debit "force deleted" event.
     *
     * @param  \App\Models\Debit  $debit
     * @return void
     */
    public function forceDeleted(Debit $debit)
    {
        event(new LogActivity($debit, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }
}
