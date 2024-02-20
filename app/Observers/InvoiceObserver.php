<?php

namespace App\Observers;

use App\Events\InvoiceCreated;
use App\Events\LogActivity;
use App\Models\Invoice;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Support\Facades\Auth;
use Pressutto\LaravelSlack\Slack;

class InvoiceObserver
{
    /**
     * Handle to the invoice "created" event.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return void
     */
    public function created(Invoice $invoice)
    {
        event(new LogActivity($invoice, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
        event(new InvoiceCreated($invoice));
    }

    /**
     * Handle the invoice "updated" event.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return void
     */
    public function updated(Invoice $invoice)
    {
        event(new LogActivity($invoice, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the invoice "deleted" event.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return void
     */
    public function deleted(Invoice $invoice)
    {
        event(new LogActivity($invoice, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the option "restored" event.
     *
     * @param  \App\Models\Option  $option
     * @return void
     */
    public function restored(Invoice $invoice)
    {
        event(new LogActivity($invoice, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the option "force deleted" event.
     *
     * @param  \App\Models\Option  $option
     * @return void
     */
    public function forceDeleted(Invoice $invoice)
    {
        event(new LogActivity($invoice, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }
}
