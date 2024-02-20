<?php

namespace App\Observers;

use App\Events\LogActivity;
use App\Models\Server;
use Illuminate\Support\Facades\Auth;

class ServerObserver
{
    /**
     * Handle the option "created" event.
     *
     * @param  \App\Models\Option  $server
     * @return void
     */
    public function created(Server $server)
    {
        event(new LogActivity($server, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the option "updated" event.
     *
     * @param  \App\Models\Option  $server
     * @return void
     */
    public function updated(Server $server)
    {
        event(new LogActivity($server, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the option "deleted" event.
     *
     * @param  \App\Models\Server  $server
     * @return void
     */
    public function deleted(Server $server)
    {
        event(new LogActivity($server, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the option "restored" event.
     *
     * @param  \App\Models\Server  $server
     * @return void
     */
    public function restored(Server $server)
    {
        event(new LogActivity($server, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the option "force deleted" event.
     *
     * @param  \App\Models\Server  $server
     * @return void
     */
    public function forceDeleted(Server $server)
    {
        event(new LogActivity($server, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }
}
