<?php

namespace App\Observers;

use App\Events\LogActivity;
use App\Models\PermissionRole;
use Illuminate\Support\Facades\Auth;

class PermissionRoleObserver
{
    /**
     * Handle the permission role "created" event.
     *
     * @param  \App\Models\PermissionRole  $permissionRole
     * @return void
     */
    public function created(PermissionRole $permissionRole)
    {
        event(new LogActivity($permissionRole, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the permission role "updated" event.
     *
     * @param  \App\Models\PermissionRole  $permissionRole
     * @return void
     */
    public function updated(PermissionRole $permissionRole)
    {
        event(new LogActivity($permissionRole, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the permission role "deleted" event.
     *
     * @param  \App\Models\PermissionRole  $permissionRole
     * @return void
     */
    public function deleted(PermissionRole $permissionRole)
    {
        event(new LogActivity($permissionRole, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the permission role "restored" event.
     *
     * @param  \App\Models\PermissionRole  $permissionRole
     * @return void
     */
    public function restored(PermissionRole $permissionRole)
    {
        event(new LogActivity($permissionRole, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the permission role "force deleted" event.
     *
     * @param  \App\Models\PermissionRole  $permissionRole
     * @return void
     */
    public function forceDeleted(PermissionRole $permissionRole)
    {
        event(new LogActivity($permissionRole, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }
}
