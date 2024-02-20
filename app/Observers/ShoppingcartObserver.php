<?php

namespace App\Observers;

use App\Events\LogActivity;
use App\Models\Shoppingcart;
use Illuminate\Support\Facades\Auth;

class ShoppingcartObserver
{
    /**
     * Handle the shoppingcart "created" event.
     *
     * @param  \App\Models\Shoppingcart  $shoppingcart
     * @return void
     */
    public function created(Shoppingcart $shoppingcart)
    {
        event(new LogActivity($shoppingcart, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the shoppingcart "updated" event.
     *
     * @param  \App\Models\Shoppingcart  $shoppingcart
     * @return void
     */
    public function updated(Shoppingcart $shoppingcart)
    {
        event(new LogActivity($shoppingcart, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the shoppingcart "deleted" event.
     *
     * @param  \App\Models\Shoppingcart  $shoppingcart
     * @return void
     */
    public function deleted(Shoppingcart $shoppingcart)
    {
        event(new LogActivity($shoppingcart, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the shoppingcart "restored" event.
     *
     * @param  \App\Models\Shoppingcart  $shoppingcart
     * @return void
     */
    public function restored(Shoppingcart $shoppingcart)
    {
        event(new LogActivity($shoppingcart, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the shoppingcart "force deleted" event.
     *
     * @param  \App\Models\Shoppingcart  $shoppingcart
     * @return void
     */
    public function forceDeleted(Shoppingcart $shoppingcart)
    {
        event(new LogActivity($shoppingcart, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }
}
