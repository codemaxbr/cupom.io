<?php

namespace App\Listeners;

use App\Events\ConfirmPayment;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyInvoicePaid
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
    public function handle(ConfirmPayment $event)
    {
        //dump('Enviar email de confirmação de pagamento para o cliente');
    }
}
