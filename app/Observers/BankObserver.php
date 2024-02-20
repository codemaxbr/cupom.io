<?php

namespace App\Observers;

use App\Events\LogActivity;
use App\Models\Bank;
use Illuminate\Support\Facades\Auth;

class BankObserver
{
    /**
     * Handle the bank "created" event.
     *
     * @param  \App\Models\Bank  $bank
     * @return void
     */
    public function created(Bank $bank)
    {
        event(new LogActivity($bank, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the bank "updated" event.
     *
     * @param  \App\Models\Bank  $bank
     * @return void
     */
    public function updated(Bank $bank)
    {
        event(new LogActivity($bank, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the bank "deleted" event.
     *
     * @param  \App\Models\Bank  $bank
     * @return void
     */
    public function deleted(Bank $bank)
    {
        event(new LogActivity($bank, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the bank "restored" event.
     *
     * @param  \App\Models\Bank  $bank
     * @return void
     */
    public function restored(Bank $bank)
    {
        event(new LogActivity($bank, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the bank "force deleted" event.
     *
     * @param  \App\Models\Bank  $bank
     * @return void
     */
    public function forceDeleted(Bank $bank)
    {
        event(new LogActivity($bank, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }
}
