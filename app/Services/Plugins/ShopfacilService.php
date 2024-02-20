<?php
namespace App\Services\Plugins;

use App\Models\Plan;
use Carbon\Carbon;

class ShopfacilService
{
    private $customer;
    private $invoice;
    private $cart;
    private $total;
    private $request;
    private $plan;

    public $chave;
    public $merchantId;
    public $urlBradesco;
    public $merchantMail;

    /**
     * ShopfacilService constructor.
     */
    public function __construct($customer, $invoice, $cart, $total, $request, $plugin)
    {
        $this->customer     = $customer;
        $this->invoice      = $invoice;
        $this->cart         = $cart;
        $this->total        = $total;
        $this->request      = $request;

        $this->setConfig($plugin);
        $this->setProduct();
    }

    public function setConfig($config)
    {
        $config             = (object)unserialize($config->config);
        $this->chave        = $config->chave;
        $this->merchantId   = $config->merchant_id;

        if ($config->env == "sandbox"):
            $this->urlBradesco = "https://homolog.meiosdepagamentobradesco.com.br/";
        else:
            $this->urlBradesco = "https://meiosdepagamentobradesco.com.br/";

        endif;
    }

    private function setProduct()
    {
        $item = $this->cart->first();
        $this->plan = Plan::find($item->id);
    }


    public function registerBoleto()
    {

        $merchantId = $this->merchantId;
        $chave = $this->chave;
        $plan = $this->plan;

        //$merchantMail = 'fernando@folhadirigida.com.br';
        //$token = $this->genereteToken($merchantId, $merchantMail, $chave);

        $data_service_pedido = array(
            "numero"     => $this->invoice->id,
            "valor"      => $this->total,
            "descricao"  => $plan->type_plan->name." - ".$plan->name,
        );

        $data_service_comprador_endereco = array
        (
            "cep"           => limpaNumeros($this->request->cep),
            "logradouro"    => $this->request->endereco,
            "numero"        => $this->request->numero,
            "complemento"   => $this->request->complemento,
            "bairro"        => $this->request->bairro,
            "cidade"        => $this->request->cidade,
            "uf"            => $this->request->estado,
        );

        $data_service_comprador = array
        (
            "nome"          => $this->customer->name,
            "documento"     => limpaNumeros($this->customer->cpf_cnpj),
            "endereco"      => $data_service_comprador_endereco,
            "ip"            => $_SERVER["REMOTE_ADDR"],
            "user_agent"    => $_SERVER["HTTP_USER_AGENT"]
        );

        $data_service_boleto_registro = NULL;

        $data_service_boleto_instrucoes = null;

        $data_service_boleto = array
        (
            "beneficiario"              => "FOLHA DIRIGIDA",
            "carteira"                  => "26",
            "nosso_numero"              => str_pad($this->invoice->id, '11', '0', STR_PAD_LEFT),
            "data_emissao"              => Carbon::now()->format('Y-m-d'),
            //"data_vencimento"         => Carbon::parse($order->created_at)->addDays(3)->format('Y-m-d'),
            "data_vencimento"           => Carbon::now()->addDays(3)->format('Y-m-d'),
            "valor_titulo"              => str_replace('.', '', number_format($this->total, 2, '.', '')),
            "url_logotipo"              => null,
            "mensagem_cabecalho"        => null,
            "tipo_renderizacao"         => "2",
            "instrucoes"                => $data_service_boleto_instrucoes,
            "registro"                  => $data_service_boleto_registro);

        $data_service_request = array
        (
            "merchant_id"                           => $merchantId,
            "meio_pagamento"                        => "300",
            "pedido"                                => $data_service_pedido,
            "comprador"                             => $data_service_comprador,
            "boleto"                                => $data_service_boleto,
            "token_request_confirmacao_pagamento"   => $chave);

        $data_post = json_encode($data_service_request);

        $url = $this->urlBradesco."/apiboleto/transacao";

        //Configuracao do cabecalho da requisicao
        $headers = array();
        $headers[] = "Accept: " . "application/json";
        $headers[] = "Accept-Charset: " . "UTF-8";
        $headers[] = "Accept-Encoding: " . "*";
        $headers[] = "Content-Type: " . "application/json" . ";charset=" . "UTF-8";

        $AuthorizationHeader        = $merchantId . ":" . $chave;
        $AuthorizationHeaderBase64  = base64_encode($AuthorizationHeader);

        $headers[] = "Authorization: Basic " . $AuthorizationHeaderBase64;

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_post);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


        $result = json_decode(curl_exec($ch));

        return (object) [
            'status' => 'success',
            'type'   => 'bill',
            'transaction' => (object) [
                'url' => $result->boleto->url_acesso,
                'id'  => $result->pedido->numero,
                'status' => 'pending',
                'token' => $result->boleto->token,
                'linha_digitavel' => $result->boleto->linha_digitavel_formatada
            ]
        ];
    }

    public function genereteToken($merchantId, $merchantMail, $chave)
    {
        $url = $this->urlBradesco . "/SPSConsulta/Authentication/" . $merchantId;

        //Configuracao do cabecalho da requisicao
        $headers = array();
        $headers[] = "Accept: " . "application/json";
        $headers[] = "Accept-Charset: " . "UTF-8";
        $headers[] = "Accept-Encoding: " . "*";
        $headers[] = "Content-Type: " . "application/json" . ";charset=" . "UTF-8";

        $AuthorizationHeader = $merchantMail . ":" . $chave;
        $AuthorizationHeaderBase64 = base64_encode($AuthorizationHeader);

        $headers[] = "Authorization: Basic " . $AuthorizationHeaderBase64;

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FAILONERROR, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);

        $result = curl_exec($ch);

        //return $result;
        dump($result);
    }

    public function getBoletosPagos($token)
    {
        $merchantId     = $this->merchantId;
        $merchantMail   = $this->merchantMail;
        $chaveSeguranca = $this->chave;

        $dataInicial    = Carbon::now()->subDays(6)->format("Y/m/d");
        $dataFinal      = Carbon::now()->format("Y/m/d");
        $status         = "1";
        $offset         = "1";
        $limit          = "1500";

        $url  = $this->urlBradesco . "/SPSConsulta/GetOrderListPayment/".$merchantId."/boleto";
        $url .= "?token=".$token."&dataInicial=".$dataInicial."&dataFinal=".$dataFinal;
        $url .= "&status=".$status."&offset=".$offset."&limit=".$limit;

        //Configuracao do cabecalho da requisicao
        $headers    = array();
        $headers[]  = "Accept: " . "application/json";
        $headers[]  = "Accept-Charset: " . "UTF-8";
        $headers[]  = "Accept-Encoding: " . "*";
        $headers[]  = "Content-Type: " . "application/json" . ";charset=" . "UTF-8";

        $AuthorizationHeader = $merchantMail . ":" . $chaveSeguranca;
        $AuthorizationHeaderBase64 = base64_encode($AuthorizationHeader);

        $headers[] = "Authorization: Basic " . $AuthorizationHeaderBase64;

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FAILONERROR, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);

        return $result = curl_exec($ch);

    }

}

