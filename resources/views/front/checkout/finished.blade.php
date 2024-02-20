@extends('layouts.auth-front')
@section('title', 'Assinatura - Login')

@section('content')

    <div class="auth">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="confirmation">
                        <center>
                            <img src="{{ asset('images/check.png') }}" alt="">
                            <h1>Assinatura realizada com sucesso!</h1>
                            <p>Obrigado, <strong>{{ $user->name }}</strong>. Enviamos a confirmação da assinatura para o seu e-mail.</p>
                            <p>Assim que seu pagamento for confirmado você poderá acessar ao conteúdo exclusivo da Folha Dirigida.</p>
                            @if($request->method_payment == "boleto")
                                <a target="_blank" href="{{ $invoice->transaction->url }}" class="btn btn-primary">
                                    IMPRIMIR BOLETO
                                </a>
                            @endif
                        </center>
                    </div>

                    <div class="pedido">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="well">
                                <h1 class="mr-t-0 text-center">Pedido #{{ $invoice->invoice->id }}</h1>

                                <div class="detalhes-pedido">
                                    <div class="row">
                                        <div class="col-md-6 text-right">Forma de pagamento:</div>
                                        @if($request->method_payment == "boleto")
                                            <div class="col-md-6"><b>Boleto Bancário</b></div>
                                        @elseif($request->method_payment == "cartao")
                                            <div class="col-md-6"><b>Cartão de Crédito</b></div>
                                        @endif
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 text-right">Total a pagar:</div>
                                        <div class="col-md-6"><b>R$ {{ numFormat($invoice->invoice->total) }}</b></div>
                                    </div>

                                    <div class="row servico_contratado text-center">
                                        <h1 class="text-center">Você está contratando:</h1>
                                        <div class="col-md-12">

                                            @foreach($cart as $item)
                                            <div class="produto">
                                                <h2>{{ $item->name }}</h2>
                                                <p>R$ {{ numFormat($item->price) }} {{ $item->options->ciclo }}</p>
                                            </div>

                                            @if($item->options->term == "Recorrente")
                                                <small>Este é um produto/serviço recorrente e será cobrado novamente no próximo vencimento.</small>
                                            @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <a href="{{ route('index') }}" class="fs-20 back-site">
                        <i class="fas fa-home"></i>
                        Voltar para o site
                    </a>
                </div>
            </div>
        </div>
    </footer>

@endsection