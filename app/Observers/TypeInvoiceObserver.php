<?php

namespace App\Observers;

use App\Events\LogActivity;
use App\Models\TypeInvoice;
use Illuminate\Support\Facades\Auth;

class TypeInvoiceObserver
{
    /**
     * Handle the type invoice "created" event.
     *
     * @param  \App\Models\TypeInvoice  $typeInvoice
     * @return void
     */
    public function created(TypeInvoice $typeInvoice)
    {
        event(new LogActivity($typeInvoice, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the type invoice "updated" event.
     *
     * @param  \App\Models\TypeInvoice  $typeInvoice
     * @return void
     */
    public function updated(TypeInvoice $typeInvoice)
    {
        event(new LogActivity($typeInvoice, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the type invoice "deleted" event.
     *
     * @param  \App\Models\TypeInvoice  $typeInvoice
     * @return void
     */
    public function deleted(TypeInvoice $typeInvoice)
    {
        event(new LogActivity($typeInvoice, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the type invoice "restored" event.
     *
     * @param  \App\Models\TypeInvoice  $typeInvoice
     * @return void
     */
    public function restored(TypeInvoice $typeInvoice)
    {
        event(new LogActivity($typeInvoice, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the type invoice "force deleted" event.
     *
     * @param  \App\Models\TypeInvoice  $typeInvoice
     * @return void
     */
    public function forceDeleted(TypeInvoice $typeInvoice)
    {
        event(new LogActivity($typeInvoice, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }
}
