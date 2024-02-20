<?php

namespace App\Observers;

use App\Events\LogActivity;
use App\Models\Import;
use Illuminate\Support\Facades\Auth;

class ImportObserver
{
    /**
     * Handle the import "created" event.
     *
     * @param  \App\Models\Import  $import
     * @return void
     */
    public function created(Import $import)
    {
        event(new LogActivity($import, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the import "updated" event.
     *
     * @param  \App\Models\Import  $import
     * @return void
     */
    public function updated(Import $import)
    {
        event(new LogActivity($import, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the import "deleted" event.
     *
     * @param  \App\Models\Import  $import
     * @return void
     */
    public function deleted(Import $import)
    {
        event(new LogActivity($import, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the import "restored" event.
     *
     * @param  \App\Models\Import  $import
     * @return void
     */
    public function restored(Import $import)
    {
        event(new LogActivity($import, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the import "force deleted" event.
     *
     * @param  \App\Models\Import  $import
     * @return void
     */
    public function forceDeleted(Import $import)
    {
        event(new LogActivity($import, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }
}
