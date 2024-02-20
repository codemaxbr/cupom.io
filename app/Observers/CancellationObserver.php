<?php

namespace App\Observers;

use App\Events\LogActivity;
use App\Models\Cancellation;
use Illuminate\Support\Facades\Auth;

class CancellationObserver
{
    /**
     * Handle the cancellation "created" event.
     *
     * @param  \App\Models\Cancellation  $cancellation
     * @return void
     */
    public function created(Cancellation $cancellation)
    {
        event(new LogActivity($cancellation, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the cancellation "updated" event.
     *
     * @param  \App\Models\Cancellation  $cancellation
     * @return void
     */
    public function updated(Cancellation $cancellation)
    {
        event(new LogActivity($cancellation, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the cancellation "deleted" event.
     *
     * @param  \App\Models\Cancellation  $cancellation
     * @return void
     */
    public function deleted(Cancellation $cancellation)
    {
        event(new LogActivity($cancellation, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the cancellation "restored" event.
     *
     * @param  \App\Models\Cancellation  $cancellation
     * @return void
     */
    public function restored(Cancellation $cancellation)
    {
        event(new LogActivity($cancellation, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the cancellation "force deleted" event.
     *
     * @param  \App\Models\Cancellation  $cancellation
     * @return void
     */
    public function forceDeleted(Cancellation $cancellation)
    {
        event(new LogActivity($cancellation, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }
}
