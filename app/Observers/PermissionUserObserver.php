<?php

namespace App\Observers;

use App\Events\LogActivity;
use App\Models\PermissionUser;
use Illuminate\Support\Facades\Auth;

class PermissionUserObserver
{
    /**
     * Handle the permission user "created" event.
     *
     * @param  \App\Models\PermissionUser  $permissionUser
     * @return void
     */
    public function created(PermissionUser $permissionUser)
    {
        event(new LogActivity($permissionUser, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the permission user "updated" event.
     *
     * @param  \App\Models\PermissionUser  $permissionUser
     * @return void
     */
    public function updated(PermissionUser $permissionUser)
    {
        event(new LogActivity($permissionUser, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the permission user "deleted" event.
     *
     * @param  \App\Models\PermissionUser  $permissionUser
     * @return void
     */
    public function deleted(PermissionUser $permissionUser)
    {
        event(new LogActivity($permissionUser, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the permission user "restored" event.
     *
     * @param  \App\Models\PermissionUser  $permissionUser
     * @return void
     */
    public function restored(PermissionUser $permissionUser)
    {
        event(new LogActivity($permissionUser, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the permission user "force deleted" event.
     *
     * @param  \App\Models\PermissionUser  $permissionUser
     * @return void
     */
    public function forceDeleted(PermissionUser $permissionUser)
    {
        event(new LogActivity($permissionUser, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }
}
