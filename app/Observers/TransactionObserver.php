<?php

namespace App\Observers;

use App\Events\LogActivity;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class TransactionObserver
{
    /**
     * Handle the transaction "created" event.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return void
     */
    public function created(Transaction $transaction)
    {
        event(new LogActivity($transaction, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the transaction "updated" event.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return void
     */
    public function updated(Transaction $transaction)
    {
        event(new LogActivity($transaction, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the transaction "deleted" event.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return void
     */
    public function deleted(Transaction $transaction)
    {
        event(new LogActivity($transaction, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the transaction "restored" event.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return void
     */
    public function restored(Transaction $transaction)
    {
        event(new LogActivity($transaction, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the transaction "force deleted" event.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return void
     */
    public function forceDeleted(Transaction $transaction)
    {
        event(new LogActivity($transaction, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }
}
