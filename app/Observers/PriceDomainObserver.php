<?php

namespace App\Observers;

use App\Models\PriceDomain;

class PriceDomainObserver
{
    /**
     * Handle the price domain "created" event.
     *
     * @param  \App\Models\PriceDomain  $priceDomain
     * @return void
     */
    public function created(PriceDomain $priceDomain)
    {
        //
    }

    /**
     * Handle the price domain "updated" event.
     *
     * @param  \App\Models\PriceDomain  $priceDomain
     * @return void
     */
    public function updated(PriceDomain $priceDomain)
    {
        //
    }

    /**
     * Handle the price domain "deleted" event.
     *
     * @param  \App\Models\PriceDomain  $priceDomain
     * @return void
     */
    public function deleted(PriceDomain $priceDomain)
    {
        //
    }

    /**
     * Handle the price domain "restored" event.
     *
     * @param  \App\Models\PriceDomain  $priceDomain
     * @return void
     */
    public function restored(PriceDomain $priceDomain)
    {
        //
    }

    /**
     * Handle the price domain "force deleted" event.
     *
     * @param  \App\Models\PriceDomain  $priceDomain
     * @return void
     */
    public function forceDeleted(PriceDomain $priceDomain)
    {
        //
    }
}
