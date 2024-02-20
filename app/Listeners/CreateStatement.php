<?php

namespace App\Listeners;

use App\Events\ConfirmPayment;
use App\Repositories\StatementRepository;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateStatement
{
    /**
     * @var StatementRepository
     */
    private $statementRepository;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(StatementRepository $statementRepository)
    {
        $this->statementRepository = $statementRepository;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(ConfirmPayment $event)
    {
        $user = $event->user;
        $invoice = $event->invoice;
        $request = $event->request;

        $items = $invoice->invoice_items;
        foreach ($items as $item){

            $description = 'Pagamento da Fatura #'.$invoice->id;
            $domain = ($item->domain != null) ? ' - '.$item->domain : '';
            $type = 'credito';

            if($invoice->type_invoice->name == 'Pedido'){
                $description = 'Assinatura do Plano "'.$item->plan->name.'"'.$domain.'.';
            }

            if($invoice->type_invoice->name == 'Recorrência'){
                $description = 'Renovação do Plano "'.$item->plan->name.'"'.$domain.'.';
            }

            if($invoice->type_invoice->name == 'Pagamento'){
                $description = 'Pagamento / Estorno referente ao plano "'.$item->plan->name.'"'.$domain.".";
                $type = 'debito';
            }

            //dd($invoice->statement, $description, $domain, $type);

            if($invoice->statement == null){
                $this->statementRepository->create([
                    'name' => $description,
                    'customer_id' => $invoice->customer_id,
                    'total' => $invoice->total,
                    'type' => $type,
                    'type_payment_id' => $request->type_payment,
                    'invoice_id' => $invoice->id,
                    'type_invoice_id' => $invoice->type_invoice->id,
                    'plan_id' => $item->plan_id,
                    'account_id' => $invoice->account_id,
                    'user_id' => @$user->id,
                ]);
            }
        }
    }
}
