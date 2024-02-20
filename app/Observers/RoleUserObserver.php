<?php

namespace App\Observers;

use App\Events\LogActivity;
use App\Models\RoleUser;
use Illuminate\Support\Facades\Auth;

class RoleUserObserver
{
    /**
     * Handle the role user "created" event.
     *
     * @param  \App\Models\RoleUser  $roleUser
     * @return void
     */
    public function created(RoleUser $roleUser)
    {
        event(new LogActivity($roleUser, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the role user "updated" event.
     *
     * @param  \App\Models\RoleUser  $roleUser
     * @return void
     */
    public function updated(RoleUser $roleUser)
    {
        event(new LogActivity($roleUser, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the role user "deleted" event.
     *
     * @param  \App\Models\RoleUser  $roleUser
     * @return void
     */
    public function deleted(RoleUser $roleUser)
    {
        event(new LogActivity($roleUser, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the role user "restored" event.
     *
     * @param  \App\Models\RoleUser  $roleUser
     * @return void
     */
    public function restored(RoleUser $roleUser)
    {
        event(new LogActivity($roleUser, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the role user "force deleted" event.
     *
     * @param  \App\Models\RoleUser  $roleUser
     * @return void
     */
    public function forceDeleted(RoleUser $roleUser)
    {
        event(new LogActivity($roleUser, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }
}
