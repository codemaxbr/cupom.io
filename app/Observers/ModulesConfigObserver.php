<?php

namespace App\Observers;

use App\Events\LogActivity;
use App\Models\ModulesConfig;
use Illuminate\Support\Facades\Auth;

class ModulesConfigObserver
{
    /**
     * Handle the modules config "created" event.
     *
     * @param  \App\Models\ModulesConfig  $modulesConfig
     * @return void
     */
    public function created(ModulesConfig $modulesConfig)
    {
        event(new LogActivity($modulesConfig, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the modules config "updated" event.
     *
     * @param  \App\Models\ModulesConfig  $modulesConfig
     * @return void
     */
    public function updated(ModulesConfig $modulesConfig)
    {
        event(new LogActivity($modulesConfig, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the modules config "deleted" event.
     *
     * @param  \App\Models\ModulesConfig  $modulesConfig
     * @return void
     */
    public function deleted(ModulesConfig $modulesConfig)
    {
        event(new LogActivity($modulesConfig, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the modules config "restored" event.
     *
     * @param  \App\Models\ModulesConfig  $modulesConfig
     * @return void
     */
    public function restored(ModulesConfig $modulesConfig)
    {
        event(new LogActivity($modulesConfig, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the modules config "force deleted" event.
     *
     * @param  \App\Models\ModulesConfig  $modulesConfig
     * @return void
     */
    public function forceDeleted(ModulesConfig $modulesConfig)
    {
        event(new LogActivity($modulesConfig, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }
}
