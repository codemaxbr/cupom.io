<?php

namespace App\Observers;

use App\Events\LogActivity;
use App\Models\InvoiceHistory;
use Illuminate\Support\Facades\Auth;

class InvoiceHistoryObserver
{
    /**
     * Handle the invoice history "created" event.
     *
     * @param  \App\Models\InvoiceHistory  $invoiceHistory
     * @return void
     */
    public function created(InvoiceHistory $invoiceHistory)
    {
        event(new LogActivity($invoiceHistory, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the invoice history "updated" event.
     *
     * @param  \App\Models\InvoiceHistory  $invoiceHistory
     * @return void
     */
    public function updated(InvoiceHistory $invoiceHistory)
    {
        event(new LogActivity($invoiceHistory, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the invoice history "deleted" event.
     *
     * @param  \App\Models\InvoiceHistory  $invoiceHistory
     * @return void
     */
    public function deleted(InvoiceHistory $invoiceHistory)
    {
        event(new LogActivity($invoiceHistory, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the invoice history "restored" event.
     *
     * @param  \App\Models\InvoiceHistory  $invoiceHistory
     * @return void
     */
    public function restored(InvoiceHistory $invoiceHistory)
    {
        event(new LogActivity($invoiceHistory, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the invoice history "force deleted" event.
     *
     * @param  \App\Models\InvoiceHistory  $invoiceHistory
     * @return void
     */
    public function forceDeleted(InvoiceHistory $invoiceHistory)
    {
        event(new LogActivity($invoiceHistory, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }
}
