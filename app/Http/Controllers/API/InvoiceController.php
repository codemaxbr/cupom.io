<?php

namespace App\Http\Controllers\API;

use App\Events\ConfirmPayment;
use App\Models\Module;
use App\Services\AccountService;
use App\Services\InvoiceService;
use App\Services\TransactionService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Vindi\WebhookHandler;

class InvoiceController extends Controller
{
    /**
     * @var InvoiceService
     */
    private $invoiceService;
    /**
     * @var AccountService
     */
    private $accountService;
    /**
     * @var TransactionService
     */
    private $transactionService;

    /**
     * InvoiceController constructor.
     */
    public function __construct(InvoiceService $invoiceService, AccountService $accountService, TransactionService $transactionService)
    {
        $this->invoiceService = $invoiceService;
        $this->accountService = $accountService;
        $this->transactionService = $transactionService;
    }

    public function confirmPayment(Request $request, $module)
    {

        $webhookHandler = new WebhookHandler();
        $event = $webhookHandler->handle();
        $plugin = Module::query()->where(['slug' => $module])->first();

        if ($request->secret === 'a54101e849c942b6e7ebbab498c21870WamaWS@1!!1') {
            $type = $event->type;
            $data = $event->data;

            if(in_array($type, ['charge_refunded', 'charge_canceled', 'charge_rejected']))
            {
                $id = $data->charge->bill->id;
                $status = $data->charge->status;
            }else {
                $id = $data->bill->id;
                $status = $data->bill->status;
            }

            if($status == "paid")
            {
                $transaction = $this->transactionService->getExternalId($id);
                $update = [
                    'status' => $status
                ];

                if($transaction->status != $status){
                    $transaction = $this->transactionService->updateTransaction($transaction->id, $update);
                }

                if($transaction->invoice->status != 1){
                    $this->invoiceService->setId($transaction->invoice->id);
                    $this->invoiceService->setStatus(1, null);
                }

                event( new ConfirmPayment($transaction->invoice, (object)['type_payment' => 2]));
            }

        }else{
            return response()->json(['message' => 'Unauthorized!'], 403);
        }

    }
}
