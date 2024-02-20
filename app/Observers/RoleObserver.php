<?php

namespace App\Observers;

use App\Events\LogActivity;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;

class RoleObserver
{
    /**
     * Handle the role "created" event.
     *
     * @param  \App\Models\Role  $role
     * @return void
     */
    public function created(Role $role)
    {
        event(new LogActivity($role, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the role "updated" event.
     *
     * @param  \App\Models\Role  $role
     * @return void
     */
    public function updated(Role $role)
    {
        event(new LogActivity($role, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the role "deleted" event.
     *
     * @param  \App\Models\Role  $role
     * @return void
     */
    public function deleted(Role $role)
    {
        event(new LogActivity($role, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the role "restored" event.
     *
     * @param  \App\Models\Role  $role
     * @return void
     */
    public function restored(Role $role)
    {
        event(new LogActivity($role, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the role "force deleted" event.
     *
     * @param  \App\Models\Role  $role
     * @return void
     */
    public function forceDeleted(Role $role)
    {
        event(new LogActivity($role, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }
}
