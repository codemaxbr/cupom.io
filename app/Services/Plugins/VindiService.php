<?php
namespace App\Services\Plugins;

use App\Events\ConfirmPayment;
use App\Models\Customer;
use App\Models\Plan;
use CodemaxBR\Vindi\Facades\Vindi;


class VindiService
{
    private $customer;
    private $invoice;
    private $cart;
    private $total;
    private $request;
    private $plan;
    private $plugin;

    /**
     * VindiService constructor.
     */
    public function __construct($customer, $invoice, $cart, $total, $request, $plugin)
    {
        $this->customer = $customer;
        $this->invoice = $invoice;
        $this->cart = $cart;
        $this->total = $total;
        $this->request = $request;
        $this->plugin = $plugin;

        $this->setConfig($this->plugin);
        $this->setProduct();
    }

    private function setConfig($config)
    {
        $config = (object) unserialize($config->config);
        Vindi::setCredentials($config->api_key, $config->env);
    }

    public function removeCustomer($id){
        return Vindi::customers()->delete($id);
    }

    private function getCustomer(Customer $customer)
    {
        try{
            $data = [
                "name"  => $customer->name,
                "email" => $customer->email,
                "registry_code" => limpaNumeros($customer->cpf_cnpj),
                "address" => [
                    "street" => ($customer->address != null) ? $customer->address->address : '',
                    "number" => ($customer->address != null) ? $customer->address->number : '',
                    "additional_details" => ($customer->address != null) ? $customer->address->additional : '',
                    "zipcode" => ($customer->address != null) ? $customer->address->zipcode : '',
                    "neighborhood" => ($customer->address != null) ? $customer->address->district : '',
                    "city" => ($customer->address != null) ? $customer->address->city : '',
                    "state" => ($customer->address != null) ? $customer->address->uf : '',
                    "country" => 'BR'
                ]
            ];

            // Se não existir um cliente da vindi salvo no banco...
            if($customer->vindi_id == null){
                // Busca pelo cliente na base de dados da vindi
                $customer_vindi = Vindi::customers()->exists(['email' => $customer->email]);

                // Se existir um cliente na Vindi
                if($customer_vindi != null){

                    // Se estiver com status "Arquivado"
                    if($customer_vindi->customers[0]->status == "archived"){
                        $customer_vindi = Vindi::customers()->unarchive($customer_vindi->customers[0]->id);
                    }

                    if(!isset($customer_vindi->customer)){
                        $customer_vindi_id = $customer_vindi->customers[0]->id;
                    }else{
                        $customer_vindi_id = $customer_vindi->customer->id;
                    }

                    $customer->vindi_id = $customer_vindi_id;
                    $customer->save();
                }else{
                    // Se não existir um cliente na Vindi, criará um novo.
                    $customer_vindi_id = Vindi::customers()->create($data)->customer->id;

                    $customer->vindi_id = $customer_vindi_id;
                    $customer->save();
                }
            }else{
                return $customer->vindi_id;
            }
        }catch (\Exception $e){
            return $e->getMessage();
        }
    }

    private function getPlan()
    {
        $plan = $this->plan;
        $cycles = $plan->type_term_id;

        $billing_cycles = 0;
        $product_vindi = $this->getProduct();

        switch ($cycles){
            case 1: $billing_cycles = null; break;
            case 2: $billing_cycles = null; break;
            case 3: $billing_cycles = 1; break;
        }

        try{
            $data = [
                "name" => $plan->name.' - '.$plan->payment_cycle->name,
                "interval" => "months",
                "interval_count" => $plan->payment_cycle->months,
                "billing_trigger_type" => "beginning_of_period",
                "billing_trigger_day" => 0,
                "billing_cycles" => $billing_cycles,
                "code" => $plan->id,
                "description" => $plan->name,
                "installments" => 1,
                "invoice_split" => false,
                "status" => ($plan->status) ? 'active' : 'inactive',
                "plan_items" => array([
                    "cycles" => null,
                    "product_id" => $product_vindi
                ]),
                "metadata" => "metadata"
            ];

            $plan_vindi = Vindi::plans()->exists(['code' => $plan->id]);
            if ($plan_vindi->plans != null){
                //return Vindi::plans()->update($plan_vindi->plans[0]->id, $data)->plan->id;
                return $plan_vindi->plans[0]->id;
            }else{
                return Vindi::plans()->create($data)->plan->id;
            }
        }catch (\Exception $e){
            return $e->getMessage();
        }
    }

    private function getPaymentProfile($request)
    {

        $this->getCustomer($this->customer);
        $customer = $this->customer;
        $cartao = valida_cartao($request->numero_cartao);

        $data = [
            'holder_name' => $request->nome_cartao,
            'card_expiration' => $request->validade_cartao,
            'card_number' => limpaNumeros($request->numero_cartao),
            'registry_code' => $this->customer->cpf_cnpj,
            'card_cvv' => $request->cvv_cartao,
            'payment_method_code' => 'credit_card',
            'payment_company_code' => $cartao[0],
            'customer_id' => $customer->vindi_id
        ];

        // Atualiza todos os cartões do cliente no banco.
        $credit_card = $customer->credit_cards()->where(['final_number' => substr($request->numero_cartao, -4)])->first();
        $response = Vindi::paymentProfiles()->exists(['customer_id' => $customer->vindi_id, 'card_number_last_four' => $credit_card->final_number, 'status' => 'active']);

        if($response->payment_profiles == null && is_null($credit_card->payment_profile_id)){

            $payment_profile_id = Vindi::paymentProfiles()->create($data)->payment_profile->id;
            $credit_card->payment_profile_id = $payment_profile_id;
            $credit_card->save();

            return $payment_profile_id;
        }

        elseif ($response->payment_profiles != null && is_null($credit_card->payment_profile_id)){
            $payment_profile_id = $response->payment_profiles[0]->id;
            $credit_card->payment_profile_id = $payment_profile_id;
            $credit_card->save();

            return $payment_profile_id;
        }
    }

    private function getProduct()
    {
        $plan = $this->plan;
        try{
            $product = [
                "name" => $plan->name,
                "description" => $plan->description,
                "status" => ($plan->status) ? 'active' : 'inactive',
                "code" => $plan->id,
                "pricing_schema" => [
                    "price" => $plan->price,
                    "schema_type" => "flat"
                ]
            ];

            $vindi_product = Vindi::products()->exists(['code' => $plan->id]);
            if ($vindi_product->products != null){
                //return Vindi::products()->update($vindi_product->products[0]->id, $product)->product->id;
                return $vindi_product->products[0]->id;
            }else{
                return Vindi::products()->create($product)->product->id;
            }
        }catch (\Exception $e){
            return $e->getMessage();
        }
    }

    private function setProduct()
    {
        $item = $this->cart->first();
        $this->plan = Plan::find($item->id);
    }

    private function getCustomerSubscription($vindi_customer_id)
    {
        try{
            $subscriptions = Vindi::subscriptions()->all(['query' => 'customer_id=' . $vindi_customer_id . ' status:active']);
            if($subscriptions->subscriptions != null){
                return $subscriptions->subscriptions;
            }else{
                return null;
            }
        }catch (\Exception $e){
            return $e->getMessage();
        }
    }

    private function cancelSubscription($id)
    {
        try {
            Vindi::subscriptions()->delete($id);
            return true;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    private function createSubscription($vindi_customer_id, $payment_profile_id)
    {
        $plan = $this->plan;
        $cycles = $plan->type_term_id;
        $invoice = $this->invoice;

        try {

            $subscription = Vindi::subscriptions()->exists(['code' => $invoice->id]);
            if($subscription->subscriptions != null){
                foreach ($subscription->subscriptions as $subscription){
                    Vindi::subscriptions()->delete($subscription->id);
                }
            }

            return Vindi::subscriptions()->create([
                //"code" => $invoice->id,
                "plan_id" => $this->getPlan(),
                "customer_id" => $vindi_customer_id,
                "installments" => 1, // à vista
                "payment_method_code" => "credit_card",
                "payment_profile" => [
                    "id" => $payment_profile_id
                ]
            ]);
        } catch (\Exception $e) {
            return false;
        }
    }

    private function createBill($vindi_customer_id, $payment_profile_id, $card_number)
    {
        $plan = $this->plan;
        $cycles = $plan->type_term_id;
        $invoice = $this->invoice;

        try {
            return Vindi::bills()->create([
                "code" => $invoice->id,
                "customer_id" => $vindi_customer_id,
                "installments" => $card_number,
                "payment_method_code" => "credit_card",
                "bill_items" => [
                    [
                        "product_id" => $this->getProduct(),
                        "amount" => $plan->price,
                        "description" => $plan->name
                    ]
                ],
                "payment_profile" => [
                    "id" => $payment_profile_id
                ]
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function registerBoleto()
    {
        //dump($this->customer);
        //dump($this->invoice);
        //dump($this->cart);
        //dump($this->total);
        //dump($this->request);
        //dump('Register Boleto = Vindi');
    }

    public function registerCartao($request, $payment_profile)
    {
        try{
            if(!is_null($payment_profile)){
                $payment_profile_id = $payment_profile;
            }else{
                $payment_profile_id = $this->getPaymentProfile($request);
            }

            $plan = $this->plan;

            if($payment_profile_id == null){
                return (object) [
                    'status' => 'error',
                    'error' => 'Não foi possível completar sua compra. Perfil de pagamento não identificado.',
                    'invoice' => $this->invoice
                ];
            }

            // Se tiver que criar uma assinatura
            if($this->plan->type_term->name == "Recorrente")
            {
                $customerSubscription = $this->getCustomerSubscription($this->customer->vindi_id);

                // Verifica se o cliente já possui uma assinatura na Vindi
                if($customerSubscription != null)
                {
                    foreach ($customerSubscription as $subscription):

                        // Verifica se o cliente está tentando assinar o mesmo plano E o mesmo produto que já tem na Vindi. (Enterrompe o processo)
                        if($subscription->plan->code == $plan->id && $subscription->product_items[0]->product->code == $plan->id){
                            return (object) [
                                'status' => 'error',
                                'type'   => 'subscription',
                                'error'  => 'Você já possui uma assinatura ativa com este plano. Não se preocupe, ela será renovada no próximo vencimento: '.dateFormat($subscription->next_billing_at, 'd/m/Y'),
                                'transaction' => null,
                                'invoice' => $this->invoice
                            ];

                            //$this->cancelSubscription($subscription->id);
                        }
                    endforeach;

                    // Se passar pelas verificações acima, cria a assinatura.
                    $newSubscription = $this->createSubscription($this->customer->vindi_id, $payment_profile_id);
                    return (object) [
                        'status' => 'success',
                        'type'   => 'subscription',
                        'subscription'  => $newSubscription->subscription,
                        'transaction'   => $newSubscription->bill,
                        'invoice' => $this->invoice
                    ];

                }else{
                    // Se passar pelas verificações acima, cria a assinatura.
                    $newSubscription = $this->createSubscription($this->customer->vindi_id, $payment_profile_id);
                    return (object) [
                        'status' => 'success',
                        'type'   => 'subscription',
                        'subscription'  => $newSubscription->subscription,
                        'transaction'   => $newSubscription->bill,
                        'invoice' => $this->invoice
                    ];
                }

            }else{
                // Se não for assinatura, cria uma fatura avulsa
                $bill = $this->createBill($this->customer->vindi_id, $payment_profile_id, limpaNumeros($request->numero_cartao));

                return (object) [
                    'status' => 'success',
                    'type'   => 'bill',
                    'transaction' => $bill,
                    'invoice' => $this->invoice
                ];
            }
        }catch (\Exception $e){
            return $e->getMessage();
        }
    }
}