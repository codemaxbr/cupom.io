<?php

namespace App\Listeners;

use App\Events\ConfirmPayment;
use App\Models\Transaction;
use App\Services\InvoiceService;
use App\Services\TransactionService;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class MakeTransaction
{
    /**
     * @var TransactionService
     */
    private $transactionService;
    /**
     * @var InvoiceService
     */
    private $invoiceService;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(TransactionService $transactionService, InvoiceService $invoiceService)
    {
        $this->transactionService = $transactionService;
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
        $module      = $event->module;
        $customer    = $event->customer;
        $transaction = $event->transaction;
        $invoice     = $event->invoice;

        if($transaction != null){
            $bill = [
                'customer_id'   => $customer->id,
                'invoice_id'    => $invoice->id,
                'total'         => $invoice->total,
                'module_id'     => $module->module->id,
                'external_id'   => $transaction->id,
                'status'        => $transaction->status,
                'url'           => $transaction->url,
                'account_id'    => $invoice->account->id
            ];

            if($transaction->status == 'paid'){
                $this->invoiceService->setId($invoice->id);
                $this->invoiceService->setStatus(1, null);
                $this->transactionService->createTransaction($bill);
                event( new ConfirmPayment($invoice, (object)['type_payment' => 2]));
            }else{
                /** @noinspection PhpInconsistentReturnPointsInspection */
                return $this->transactionService->createTransaction($bill);
            }
        }
    }
}
