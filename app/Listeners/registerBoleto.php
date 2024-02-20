<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class registerBoleto
{
    private $service;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $invoice    = $event->invoice;
        $customer   = $event->customer;
        $request    = $event->request;
        $plugin     = $event->module;
        $cart       = $request->session()->get('cart');
        $total      = $request->session()->get('total_cart');

        $serviceName = '\App\Services\Plugins\\'.$plugin->module->name.'Service';
        $this->service = new $serviceName($customer, $invoice, $cart, $total, $request, $plugin);

        $responseGateway = $this->service->registerBoleto();

        $event->transaction = $responseGateway->transaction;
        return $responseGateway;
    }
}
