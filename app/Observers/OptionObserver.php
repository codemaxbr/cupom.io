<?php

namespace App\Observers;

use App\Events\LogActivity;
use App\Models\Option;
use Illuminate\Support\Facades\Auth;

class OptionObserver
{
    /**
     * Handle the option "created" event.
     *
     * @param  \App\Models\Option  $option
     * @return void
     */
    public function created(Option $option)
    {
        event(new LogActivity($option, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the option "updated" event.
     *
     * @param  \App\Models\Option  $option
     * @return void
     */
    public function updated(Option $option)
    {
        event(new LogActivity($option, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the option "deleted" event.
     *
     * @param  \App\Models\Option  $option
     * @return void
     */
    public function deleted(Option $option)
    {
        event(new LogActivity($option, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the option "restored" event.
     *
     * @param  \App\Models\Option  $option
     * @return void
     */
    public function restored(Option $option)
    {
        event(new LogActivity($option, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the option "force deleted" event.
     *
     * @param  \App\Models\Option  $option
     * @return void
     */
    public function forceDeleted(Option $option)
    {
        event(new LogActivity($option, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }
}
