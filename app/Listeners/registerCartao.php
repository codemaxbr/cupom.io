<?php

namespace App\Listeners;

use App\Models\CreditCard;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class registerCartao
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

    private function checkCartao($request, $customer)
    {
        if(isset($request->payment_profile) && $request->payment_profile != "new"){
            return $request->payment_profile;
        }else{
            $cartao = valida_cartao($request->numero_cartao);
            $n_cartao = limpaNumeros($request->numero_cartao);

            if($cartao[1]){
                $card = [
                    'flag' => $cartao[0],
                    'start_number' => substr($n_cartao, 0, 6),
                    'final_number' => substr($n_cartao, -4),
                    'owner' => $request->nome_cartao,
                    'expires' => $request->validade_cartao,
                    'customer_id' => $customer->id,
                    'account_id' => $customer->account->id
                ];

                return CreditCard::query()->where(['start_number' => substr($n_cartao, 0, 6), 'final_number' => substr($n_cartao, -4)])->firstOrCreate($card)->payment_profile_id;
            }
        }

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

        $payment_profile = $this->checkCartao($request, $customer);
        $responseGateway = $this->service->registerCartao($request, $payment_profile);

        if($responseGateway->status == 'success'){
            $event->transaction = $responseGateway->transaction;
        }

        if($responseGateway->status == 'error'){
            $responseGateway->invoice->delete();
            $event->transaction = null;
        }

        return $responseGateway;
    }
}
