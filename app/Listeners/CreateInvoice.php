<?php

namespace App\Listeners;

use App\Models\Account;
use App\Services\InvoiceService;
use Carbon\Carbon;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Webpatser\Uuid\Uuid;

class CreateInvoice
{
    /**
     * @var InvoiceService
     */
    private $invoiceService;

    /**
     * Create the event listener.
     *
     * @param InvoiceService $invoiceService
     */
    public function __construct(InvoiceService $invoiceService)
    {
        $this->invoiceService = $invoiceService;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $customer   = $event->customer;
        $request    = $event->request;
        $module     = $event->module;
        $cart       = $request->session()->get('cart');
        $total      = $request->session()->get('total_cart');

        $inv = array(
            'customer_id'       => $customer->id,
            'type_invoice_id'   => 2,
            'due'               => Carbon::now()->addDays(5)->format('Y-m-d'),
            'created_at'        => Carbon::now(),
            'account_id'        => $customer->account_id,
            'total'             => $total,
            'uuid'              => Uuid::generate(4)->string,
            'status'            => 0,
            'invoice_items'     => array()
        );

        foreach ($cart as $item)
        {
            $item = (object) $item;

            $add_item = array(
                'type_plan_id'  => $item->options->type,
                'plan_id'       => $item->id,
                //'domain'        => $item->options->dominio,
                'description'   => $item->name,
                'price'         => $item->price,
                'discount'      => 0,
                'qty'           => $item->qty
            );

            array_push($inv['invoice_items'], $add_item);
        }

        return $event->invoice = $this->invoiceService->newInvoice($inv);
    }
}
