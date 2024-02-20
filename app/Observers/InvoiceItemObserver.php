<?php

namespace App\Observers;

use App\Events\LogActivity;
use App\Models\InvoiceItem;
use Illuminate\Support\Facades\Auth;

class InvoiceItemObserver
{
    /**
     * Handle the invoice item "created" event.
     *
     * @param  \App\Models\InvoiceItem  $invoiceItem
     * @return void
     */
    public function created(InvoiceItem $invoiceItem)
    {
        event(new LogActivity($invoiceItem, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the invoice item "updated" event.
     *
     * @param  \App\Models\InvoiceItem  $invoiceItem
     * @return void
     */
    public function updated(InvoiceItem $invoiceItem)
    {
        event(new LogActivity($invoiceItem, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the invoice item "deleted" event.
     *
     * @param  \App\Models\InvoiceItem  $invoiceItem
     * @return void
     */
    public function deleted(InvoiceItem $invoiceItem)
    {
        event(new LogActivity($invoiceItem, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the invoice item "restored" event.
     *
     * @param  \App\Models\InvoiceItem  $invoiceItem
     * @return void
     */
    public function restored(InvoiceItem $invoiceItem)
    {
        event(new LogActivity($invoiceItem, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the invoice item "force deleted" event.
     *
     * @param  \App\Models\InvoiceItem  $invoiceItem
     * @return void
     */
    public function forceDeleted(InvoiceItem $invoiceItem)
    {
        event(new LogActivity($invoiceItem, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }
}
