<?php

namespace App\Observers;

use App\Events\LogActivity;
use App\Models\TypeTerm;
use Illuminate\Support\Facades\Auth;

class TypeTermObserver
{
    /**
     * Handle the type term "created" event.
     *
     * @param  \App\Models\TypeTerm  $typeTerm
     * @return void
     */
    public function created(TypeTerm $typeTerm)
    {
        event(new LogActivity($typeTerm, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the type term "updated" event.
     *
     * @param  \App\Models\TypeTerm  $typeTerm
     * @return void
     */
    public function updated(TypeTerm $typeTerm)
    {
        event(new LogActivity($typeTerm, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the type term "deleted" event.
     *
     * @param  \App\Models\TypeTerm  $typeTerm
     * @return void
     */
    public function deleted(TypeTerm $typeTerm)
    {
        event(new LogActivity($typeTerm, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the type term "restored" event.
     *
     * @param  \App\Models\TypeTerm  $typeTerm
     * @return void
     */
    public function restored(TypeTerm $typeTerm)
    {
        event(new LogActivity($typeTerm, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the type term "force deleted" event.
     *
     * @param  \App\Models\TypeTerm  $typeTerm
     * @return void
     */
    public function forceDeleted(TypeTerm $typeTerm)
    {
        event(new LogActivity($typeTerm, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }
}
