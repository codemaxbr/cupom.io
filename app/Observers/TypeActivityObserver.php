<?php

namespace App\Observers;

use App\Events\LogActivity;
use App\Models\TypeActivity;
use Illuminate\Support\Facades\Auth;

class TypeActivityObserver
{
    /**
     * Handle the type activity "created" event.
     *
     * @param  \App\Models\TypeActivity  $typeActivity
     * @return void
     */
    public function created(TypeActivity $typeActivity)
    {
        event(new LogActivity($typeActivity, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the type activity "updated" event.
     *
     * @param  \App\Models\TypeActivity  $typeActivity
     * @return void
     */
    public function updated(TypeActivity $typeActivity)
    {
        event(new LogActivity($typeActivity, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the type activity "deleted" event.
     *
     * @param  \App\Models\TypeActivity  $typeActivity
     * @return void
     */
    public function deleted(TypeActivity $typeActivity)
    {
        event(new LogActivity($typeActivity, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the type activity "restored" event.
     *
     * @param  \App\Models\TypeActivity  $typeActivity
     * @return void
     */
    public function restored(TypeActivity $typeActivity)
    {
        event(new LogActivity($typeActivity, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the type activity "force deleted" event.
     *
     * @param  \App\Models\TypeActivity  $typeActivity
     * @return void
     */
    public function forceDeleted(TypeActivity $typeActivity)
    {
        event(new LogActivity($typeActivity, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }
}
