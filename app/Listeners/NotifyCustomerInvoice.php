<?php

namespace App\Listeners;

use App\Events\Event;
use App\Events\InvoiceCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyCustomerInvoice
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(InvoiceCreated $event)
    {
        $invoice = $event->invoice;
        //dump($invoice);
    }
}
