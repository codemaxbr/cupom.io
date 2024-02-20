<?php

namespace App\Observers;

use App\Events\LogActivity;
use App\Models\Combo;
use App\Models\Optional;
use Illuminate\Support\Facades\Auth;

class OptionalObserver
{
    /**
     * Handle the combo "created" event.
     *
     * @param  \App\Models\Combo  $combo
     * @return void
     */
    public function created(Optional $combo)
    {
        event(new LogActivity($combo, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the combo "updated" event.
     *
     * @param  \App\Models\Combo  $combo
     * @return void
     */
    public function updated(Optional $combo)
    {
        event(new LogActivity($combo, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the combo "deleted" event.
     *
     * @param  \App\Models\Combo  $combo
     * @return void
     */
    public function deleted(Optional $combo)
    {
        event(new LogActivity($combo, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the combo "restored" event.
     *
     * @param  \App\Models\Combo  $combo
     * @return void
     */
    public function restored(Optional $combo)
    {
        event(new LogActivity($combo, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the combo "force deleted" event.
     *
     * @param  \App\Models\Combo  $combo
     * @return void
     */
    public function forceDeleted(Optional $combo)
    {
        event(new LogActivity($combo, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }
}
