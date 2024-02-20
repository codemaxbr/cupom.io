<?php

namespace App\Observers;

use App\Events\LogActivity;
use App\Models\Permission;
use Illuminate\Support\Facades\Auth;

class PermissionObserver
{
    /**
     * Handle the permission "created" event.
     *
     * @param  \App\Models\Permission  $permission
     * @return void
     */
    public function created(Permission $permission)
    {
        event(new LogActivity($permission, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the permission "updated" event.
     *
     * @param  \App\Models\Permission  $permission
     * @return void
     */
    public function updated(Permission $permission)
    {
        event(new LogActivity($permission, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the permission "deleted" event.
     *
     * @param  \App\Models\Permission  $permission
     * @return void
     */
    public function deleted(Permission $permission)
    {
        event(new LogActivity($permission, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the permission "restored" event.
     *
     * @param  \App\Models\Permission  $permission
     * @return void
     */
    public function restored(Permission $permission)
    {
        event(new LogActivity($permission, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the permission "force deleted" event.
     *
     * @param  \App\Models\Permission  $permission
     * @return void
     */
    public function forceDeleted(Permission $permission)
    {
        event(new LogActivity($permission, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }
}
