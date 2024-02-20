<?php

namespace App\Observers;

use App\Events\LogActivity;
use App\Models\Provider;
use Illuminate\Support\Facades\Auth;

class ProviderObserver
{
    /**
     * Handle the provider "created" event.
     *
     * @param  \App\Models\Provider  $provider
     * @return void
     */
    public function created(Provider $provider)
    {
        event(new LogActivity($provider, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the provider "updated" event.
     *
     * @param  \App\Models\Provider  $provider
     * @return void
     */
    public function updated(Provider $provider)
    {
        event(new LogActivity($provider, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the provider "deleted" event.
     *
     * @param  \App\Models\Provider  $provider
     * @return void
     */
    public function deleted(Provider $provider)
    {
        event(new LogActivity($provider, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the provider "restored" event.
     *
     * @param  \App\Models\Provider  $provider
     * @return void
     */
    public function restored(Provider $provider)
    {
        event(new LogActivity($provider, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the provider "force deleted" event.
     *
     * @param  \App\Models\Provider  $provider
     * @return void
     */
    public function forceDeleted(Provider $provider)
    {
        event(new LogActivity($provider, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }
}
