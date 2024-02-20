<?php

namespace App\Observers;

use App\Models\AbandonedCart;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class AbandonedCartObserver
{
    public function creating(AbandonedCart $abandoned_cart)
    {
        //
    }

    public function updating(AbandonedCart $abandoned_cart)
    {
        //
    }
}