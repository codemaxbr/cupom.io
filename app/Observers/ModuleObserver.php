<?php

namespace App\Observers;

use App\Events\LogActivity;
use App\Models\Module;
use Illuminate\Support\Facades\Auth;

class ModuleObserver
{
    /**
     * Handle the module "created" event.
     *
     * @param  \App\Models\Module  $module
     * @return void
     */
    public function created(Module $module)
    {
        event(new LogActivity($module, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the module "updated" event.
     *
     * @param  \App\Models\Module  $module
     * @return void
     */
    public function updated(Module $module)
    {
        event(new LogActivity($module, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the module "deleted" event.
     *
     * @param  \App\Models\Module  $module
     * @return void
     */
    public function deleted(Module $module)
    {
        event(new LogActivity($module, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the module "restored" event.
     *
     * @param  \App\Models\Module  $module
     * @return void
     */
    public function restored(Module $module)
    {
        event(new LogActivity($module, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the module "force deleted" event.
     *
     * @param  \App\Models\Module  $module
     * @return void
     */
    public function forceDeleted(Module $module)
    {
        event(new LogActivity($module, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }
}
