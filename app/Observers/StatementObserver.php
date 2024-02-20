<?php

namespace App\Observers;

use App\Events\LogActivity;
use App\Models\Statement;
use Illuminate\Support\Facades\Auth;

class StatementObserver
{
    /**
     * Handle the statement "created" event.
     *
     * @param  \App\Models\Statement  $statement
     * @return void
     */
    public function created(Statement $statement)
    {
        event(new LogActivity($statement, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the statement "updated" event.
     *
     * @param  \App\Models\Statement  $statement
     * @return void
     */
    public function updated(Statement $statement)
    {
        event(new LogActivity($statement, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the statement "deleted" event.
     *
     * @param  \App\Models\Statement  $statement
     * @return void
     */
    public function deleted(Statement $statement)
    {
        event(new LogActivity($statement, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the statement "restored" event.
     *
     * @param  \App\Models\Statement  $statement
     * @return void
     */
    public function restored(Statement $statement)
    {
        event(new LogActivity($statement, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the statement "force deleted" event.
     *
     * @param  \App\Models\Statement  $statement
     * @return void
     */
    public function forceDeleted(Statement $statement)
    {
        event(new LogActivity($statement, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }
}
