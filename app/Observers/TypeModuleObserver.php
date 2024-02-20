<?php

namespace App\Observers;

use App\Events\LogActivity;
use App\Models\TypeModule;
use Illuminate\Support\Facades\Auth;

class TypeModuleObserver
{
    /**
     * Handle the type module "created" event.
     *
     * @param  \App\Models\TypeModule  $typeModule
     * @return void
     */
    public function created(TypeModule $typeModule)
    {
        event(new LogActivity($typeModule, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the type module "updated" event.
     *
     * @param  \App\Models\TypeModule  $typeModule
     * @return void
     */
    public function updated(TypeModule $typeModule)
    {
        event(new LogActivity($typeModule, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the type module "deleted" event.
     *
     * @param  \App\Models\TypeModule  $typeModule
     * @return void
     */
    public function deleted(TypeModule $typeModule)
    {
        event(new LogActivity($typeModule, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the type module "restored" event.
     *
     * @param  \App\Models\TypeModule  $typeModule
     * @return void
     */
    public function restored(TypeModule $typeModule)
    {
        event(new LogActivity($typeModule, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the type module "force deleted" event.
     *
     * @param  \App\Models\TypeModule  $typeModule
     * @return void
     */
    public function forceDeleted(TypeModule $typeModule)
    {
        event(new LogActivity($typeModule, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }
}
