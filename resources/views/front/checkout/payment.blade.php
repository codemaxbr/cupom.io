@extends('layouts.auth-front')
@section('title', 'Assinatura - Login')

@section('content')

    <div id="carrinho">
        <div class="container">
            <div class="row">
                <div class="col-xs-3 col-md-12">
                    <div class="row">
                        <ol class="col-xs-11">
                            <li>
                            <span class="icones-header">
                                <!--<i class="fa fa-shopping-cart"></i>-->
                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="19px" height="19px" viewBox="0 0 80 80" enable-background="new 0 0 80 80" xml:space="preserve">
                                <circle fill-rule="evenodd" clip-rule="evenodd" fill="#469AFF" cx="27.6" cy="69.6" r="7.4"></circle>
                                <circle fill-rule="evenodd" clip-rule="evenodd" fill="#469AFF" cx="62.1" cy="69.6" r="7.4"></circle>
                                <path fill-rule="evenodd" clip-rule="evenodd" fill="#469AFF" d="M77.8,12.9H17.7l-2.4-8.3C15,3.7,14.5,3,13.2,3H2
                                    C1.1,3,0.4,3.7,0.4,4.5v1.9c0,0.9,0.7,1.5,1.5,1.5h9.3l13.8,47.8c0.3,1,0.9,1.4,1.8,1.5c0.1,0,0.4,0,0.4,0H63c0.9,0,1.5-0.7,1.5-1.5
                                    v-1.8c0-0.9-0.7-1.5-1.5-1.5h-34l-2.9-9.9h42.7c0.9,0,1.8-0.7,2-1.5c0,0,8.3-25.9,8.4-26.2c0.1-0.3,0.2-0.7-0.2-1.3
                                    C78.8,13.1,78.3,12.9,77.8,12.9z"></path>
                                </svg>
                            </span>
                                <p>PRODUTO SELECIONADO</p>
                            </li>

                            <li>
                            <span class="icones-header">
                                <!--<i class="fas fa-dollar-sign"></i>-->
                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="17px" height="17px" viewBox="0 0 80 80" enable-background="new 0 0 80 80" xml:space="preserve">
                                <path fill="#23BA37" d="M42.1,79.8c0.8,0,1.5-0.7,1.5-1.5c0,0,0,0.1,0,0v-6.8c5.5-0.5,9.8-2.1,13-4.5c0,0,0,0,0.1,0
                                    c1.9-1.5,3.4-3.2,4.5-5.1c1.5-2.7,2.3-5.8,2.3-9.1c0-6.1-2.5-10-6.2-12.7c-3.8-2.8-8.8-4.3-13.6-5.6V18.7c2.2,0.5,4.4,1.2,6.5,2.3
                                    c1.5,0.8,3,1.7,4.4,2.9c0.1,0.1,0.7,0.7,1.4,0.7c0.7-0.1,1.1-0.7,1.1-0.7l4.1-5.4c0,0,0.1-0.1,0.1-0.2c0.2-0.2,0.5-0.7,0.4-1.1
                                    c-0.1-0.6-0.8-1.1-0.9-1.1c-1.3-1.1-2.6-2-4-2.9c0,0,0,0-0.1,0c-3.8-2.2-8.1-3.7-13-4.2c0,0,0-0.1,0-0.3V1.8c0,0,0,0,0,0
                                    c0-0.8-0.7-1.5-1.5-1.5h-4.4c-0.8,0-1.5,0.7-1.5,1.5c0,0,0,0,0,0v7c-9.7,0.8-16.6,6-18.6,13.1c-0.5,1.5-0.7,3.1-0.7,4.7
                                    c0,6.9,3.3,10.9,7.9,13.5c3.4,1.9,7.4,3.1,11.4,4.1V62c-0.8-0.1-1.5-0.3-2.2-0.5c-4.4-1.1-8.2-3.3-11-5.8c-1.1-1-2.5-1.3-3.4-0.1
                                    c-0.6,0.8-2.3,3.2-3.5,4.9c-0.7,0.9-0.6,2.1,0.1,2.8c4.8,4.4,11.4,7.6,20.1,8.3v6.8c0,0,0,0,0,0c0,0.8,0.7,1.5,1.5,1.5H42.1z
                                     M36.2,32.6c-4.9-1.5-8.3-3.3-8.3-6.9c0-3.4,2.3-6,6.1-7.1c0.7-0.2,1.4-0.4,2.2-0.5V32.6z M50,59.2c-1.4,1.4-3.5,2.4-6.5,2.8V46.1
                                    c5,1.6,8.9,3.6,8.9,7.7C52.4,55.7,51.7,57.7,50,59.2z"></path>
                                </svg>
                            </span>
                                <p>PREÇO</p>
                            </li>

                            <li>
                            <span class="icones-header">
                                <!--<i class="fa fa-star"></i>-->
                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="18px" height="18px" viewBox="0 0 80 80" enable-background="new 0 0 80 80" xml:space="preserve">
                                <path fill="#F5C300" d="M79.9,31.6c0,0.8-0.4,1.4-1,1.8L58.4,49.8l6.9,25.2l0.1,0.5c0,0.1,0,0.2,0,0.4c0,1.2-1,2.2-2.2,2.2
                                    c-0.4,0-0.9-0.1-1.2-0.4L40,63.2L17.9,77.7c-0.3,0.2-0.8,0.4-1.2,0.4c-1.2,0-2.2-1-2.2-2.2c0-0.1,0.1-0.7,0.2-0.8l6.9-25.3L1.1,33.4
                                    c-0.1-0.1-0.2-0.2-0.3-0.3c-0.4-0.4-0.6-0.9-0.6-1.5c0-1.2,1-2.2,2.2-2.2l26.3-1.2L38,3.5c0-0.1,0-0.1,0.1-0.2C38.4,2.5,39.2,2,40,2
                                    c0.9,0,1.6,0.5,2,1.3c0,0.1,0.1,0.1,0.1,0.2l9.4,24.7l26.2,1.2H78C79,29.5,79.9,30.5,79.9,31.6z"></path>
                                </svg>
                            </span>
                                <p>DESCRIÇÃO</p>
                            </li>
                        </ol>
                    </div>
                </div>
                <div class="col-xs-9 col-sm-12 produto-pai">
                    @foreach($cart as $item)
                        <div class="row produto">
                            <ol class="col-xs-11">
                                <li>
                                    <h3 class="nome-produto">
                                        {{ $item->name }}
                                    </h3>
                                </li>
                                <li class="preco-produto">
                                    <h3>R$ {{ numFormat($item->price) }} <span>{{ $item->options->ciclo }}</span></h3>
                                </li>
                                <li class="promocao-produto">
                                    <h3>
                                        {{ $item->options->months }} @if($item->options->months > 1) meses @else mês @endif de assinatura
                                        <span>{{ $item->options->term }}</span>
                                    </h3>
                                </li>
                            </ol>
                            <div class="col-xs-1">
                                <a href="#" class="btn btn-white remove-item">
                                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="18px" height="18px" viewBox="0 0 80 80" enable-background="new 0 0 80 80" xml:space="preserve">
                                    <g>
                                        <path fill-rule="evenodd" clip-rule="evenodd" fill="#333333" d="M71.3,13.2H53.2V2c0-1.1-0.9-2.1-2.1-2.1H28.9
                                            c-1.1,0-2.1,0.9-2.1,2.1v11.2H9c-1.1,0-2.1,0.9-2.1,2.1v2.5c0,1.1,0.9,2.1,2.1,2.1h62.3c1.1,0,2.1-0.9,2.1-2.1v-2.5
                                            C73.4,14.2,72.5,13.2,71.3,13.2z M46.8,11.2c0,1.1-0.9,2.1-2.1,2.1h-9.1c-1.1,0-2.1-0.9-2.1-2.1V8.7c0-1.1,0.9-2.1,2.1-2.1h9.1
                                            c1.1,0,2.1,0.9,2.1,2.1V11.2z"></path>
                                        <path fill-rule="evenodd" clip-rule="evenodd" fill="#333333" d="M58.6,26.5V69c0,1.1-0.9,2.1-2.1,2.1H54c-1.1,0-2.1-0.9-2.1-2.1
                                            V26.5h-8.5V69c0,1.1-0.9,2.1-2.1,2.1h-2.5c-1.1,0-2.1-0.9-2.1-2.1V26.5h-8.5V69c0,1.1-0.9,2.1-2.1,2.1h-2.5c-1.1,0-2.1-0.9-2.1-2.1
                                            V26.5h-6.1v0h-2.1v3.3h0v47.8c0,1.1,0.9,2.1,2.1,2.1h49c1.1,0,2.1-0.9,2.1-2.1v-51c0,0,0-0.1,0-0.1H58.6z"></path>
                                    </g>
                                </svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="auth">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-sm-push-7 col-md-4 col-md-offset-1 col-md-push-7">
                    <h2>Olá, <b>{{ $user->name }}</b></h2>
                    <p>
                        Confirme os dados do <b>seu cadastro</b><br />
                        Não é você? <a href="#"><b>Alterar</b></a>
                    </p>

                    <form action="{{ route('checkout.login') }}" class="box-login" method="post">
                        <div class="form-group">
                            <label for="nome">Endereço de E-mail: <br /><b>{{ $user->email }}</b></label>
                        </div>

                        <div class="form-group">
                            <label for="nome">Nome completo: <br /><b>{{ $user->name }}</b></label>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cpf">CPF: <br /><b>{{ $user->cpf_cnpj }}</b></label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password">Data de nascimento: <br /><b>{{ $user->birthdate->format('d/m/Y') }}</b></label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cpf">Celular: <br /><b>{{ $user->mobile }}</b></label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cpf">Gênero: <br />
                                        @switch($user->genre)
                                            @case('M') <b>Masculino</b> @break
                                            @case('F') <b>Feminino</b> @break
                                            @default <b>Não informado</b> @break
                                        @endswitch
                                    </label>
                                </div>
                            </div>
                        </div>
                    </form>
                    <hr>
                </div>
                <span class="col-xs-12 col-md-1 col-md-push-1 borda"></span>

                <div class="col-xs-12 col-md-6 col-md-pull-6">

                    <h1>DADOS DE PAGAMENTO</h1>
                    <p>
                        Para finalizar sua compra, <b>confirme os dados</b> do seu cadastro<br />
                        Campos com asterisco (*) são obrigatórios.
                    </p>

                    <div class="ux-card config-step">

                        <div class="row">
                            <div class="col-xs-12 col-md-6 no-padding-right">
                                <label for="cartao" style="width: 100%;">
                                    <div class="selector selected" type="cartao">
                                        <div class="radio">
                                            <input type="radio" id="cartao" checked name="forma_pagamento" value="cartao">
                                            <label for="credit-card">
                                                <i class="sprite-pagamento i-p-credit-card" style="margin-right: 67.5%;"></i>
                                                Cartão de crédito
                                            </label>
                                        </div>
                                    </div>
                                </label>
                            </div>

                            <div class="col-xs-12 col-md-6">
                                <label for="boleto" style="width: 100%;">
                                    <div class="selector" type="boleto">
                                        <div class="radio">
                                            <input type="radio" id="boleto" name="forma_pagamento" value="boleto">
                                            <label for="credit-card">
                                                <i class="sprite-pagamento i-p-bankslip" style="margin-right: 55px;"></i>
                                                Boleto
                                            </label>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>

                    <form class="cartao" method="post" action="{{ route('checkout.finished') }}">
                        @csrf
                        <input type="hidden" class="method_payment" name="method_payment" value="cartao" />
                        <h1 class="fs-20 mr-b-20">Insira os dados do cartão e do titular do cartão</h1>
                        <div class="pague-com">
                            <label class="payment-type-label">Pague com:</label>
                            <div class="payment-with">
                                <i class="sprite-pagamento i-p-visa"></i>
                                <i class="sprite-pagamento i-p-mastercard"></i>
                                <i class="sprite-pagamento i-p-american"></i>
                                <i class="sprite-pagamento i-p-diners"></i>
                                <i class="sprite-pagamento i-p-elo"></i>
                            </div>
                        </div>

                        @if($user->credit_cards->isNotEmpty())
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="card_type">Escolha o seu cartão <b class="text-red">*</b></label>
                                    <select name="payment_profile" id="card_type" required value="{{ old('payment_profile') }}" class="form-control">
                                        <optgroup label="Meus cartões">
                                            @foreach($user->credit_cards as $card)
                                            <option value="{{ ($card->payment_profile_id != null) ? $card->payment_profile_id : 0 }}">{{ $card->flag }} **** **** **** {{ $card->final_number }}</option>
                                            @endforeach
                                        </optgroup>

                                        <optgroup label="Novo cartão de crédito">
                                            <option value="new">Usar um novo cartão</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row new_card" style="display: none;">
                        @else
                        <div class="row new_card">
                        @endif
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="numero_cartao">Número do cartão <b class="text-red">*</b></label>
                                    <input type="text" name="numero_cartao" id="numero_cartao" required value="{{ old('numero_cartao') }}" class="form-control formatCREDIT" placeholder="0000-0000-0000-0000" />
                                </div>

                                <div class="form-group">
                                    <label for="mes">Validade <b class="text-red">*</b></label>
                                    <input type="text" name="validade_cartao" id="validade_cartao" placeholder="mm/aaaa" value="{{ old('validade_cartao') }}" required class="form-control formatVALIDATE">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nome_cartao">Nome do titular (impresso) <b class="text-red">*</b></label>
                                    <input type="text" id="nome_cartao" name="nome_cartao" required class="form-control" value="{{ old('nome_cartao') }}" placeholder="" />
                                </div>

                                <div class="form-group">
                                    <label for="cvv_cartao">Código de Segurança (CVV) <b class="text-red">*</b></label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="text" id="cvv_cartao" name="cvv_cartao" required class="form-control" value="{{ old('cvv_cartao') }}" placeholder="" />
                                        </div>

                                        <div class="col-md-6 no-padding-left">
                                            <a href="#" class="d-inline-block mr-t-10">O que é isso?</a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        @if (session('response'))
                            <div class="alert alert-danger">
                                <i class="icone-attention"></i>
                                {{ session('response') }}
                            </div>
                        @endif

                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary">
                                FINALIZAR COMPRA
                            </button>
                        </div>
                    </form>

                    <form class="boleto" method="post" style="display: none;" action="{{ route('checkout.finished') }}">
                        @csrf
                        <input type="hidden" class="method_payment" name="method_payment" value="cartao" />
                        <h1 class="fs-20 mr-b-20">Pagar com Boleto Bancário</h1>

                        <div class="row">
                            <div class="col-md-2">
                                <img src="{{ asset('images/pagamento/boleto.png') }}" alt="">
                            </div>

                            <div class="col-md-10">
                                <p class="mr-t-0">
                                    O boleto será enviado para seu e-mail e o plano contratado
                                    será liberado para uso após a confirmação do pagamento.
                                </p>

                                <p>
                                    Para ativação da conta em menos de 12 horas, você deve enviar a
                                    imagem do comprovante para <a href="#"><b>pago@folhadirigida.com.br</b></a>
                                </p>
                            </div>
                        </div>

                        <div class="endereco" style="display: none;">
                            <h1 class="fs-20 mr-t-20 mr-b-20">Dados de endereço</h1>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="cep">CEP <b class="text-red">*</b></label>
                                        <input type="text" name="cep" value="{{ old('cep') }}" id="cep" required class="form-control formatCEP buscaCEP" placeholder="" />
                                        <small><a href="#">Não sei meu CEP</a></small>
                                    </div>
                                </div>

                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="endereco">Endereço <b class="text-red">*</b></label>
                                        <input type="text" name="endereco" value="{{ old('endereco') }}" required id="endereco" class="form-control" placeholder="" />
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="numero">Número <b class="text-red">*</b></label>
                                        <input type="text" name="numero" required id="numero" value="{{ old('numero') }}" class="form-control" placeholder="" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cidade">Cidade <b class="text-red">*</b></label>
                                        <input type="text" name="cidade" required id="cidade" value="{{ old('cidade') }}" class="form-control" placeholder="" />
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="estado">Estado <b class="text-red">*</b></label>
                                        <select name="estado" id="estado" required class="form-control">
                                            <option value="">UF</option>
                                            <option value="AC">AC</option>
                                            <option value="AL">AL</option>
                                            <option value="AP">AP</option>
                                            <option value="AM">AM</option>
                                            <option value="BA">BA</option>
                                            <option value="CE">CE</option>
                                            <option value="DF">DF</option>
                                            <option value="ES">ES</option>
                                            <option value="GO">GO</option>
                                            <option value="MA">MA</option>
                                            <option value="MT">MT</option>
                                            <option value="MS">MS</option>
                                            <option value="MG">MG</option>
                                            <option value="PA">PA</option>
                                            <option value="PB">PB</option>
                                            <option value="PR">PR</option>
                                            <option value="PE">PE</option>
                                            <option value="PI">PI</option>
                                            <option value="RJ">RJ</option>
                                            <option value="RN">RN</option>
                                            <option value="RS">RS</option>
                                            <option value="RO">RO</option>
                                            <option value="RR">RR</option>
                                            <option value="SC">SC</option>
                                            <option value="SP">SP</option>
                                            <option value="SE">SE</option>
                                            <option value="TO">TO</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="bairro">Bairro <b class="text-red">*</b></label>
                                        <input type="text" name="bairro" value="{{ old('bairro') }}" required id="bairro" class="form-control" placeholder="" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="complemento">Complemento</label>
                                        <input type="text" name="complemento" id="complemento" value="{{ old('complemento') }}" class="form-control" placeholder="" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary">
                                FINALIZAR COMPRA
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <section class="pagamentos">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-3 col-md-3">
                        <h5>cartão de crédito</h5>
                        <div class="cartoes-credito">
                            <span class="visa"></span>
                            <span class="master"></span>
                            <span class="diners"></span>
                            <span class="amex"></span>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-3 col-md-3">
                        <h5>débito automático</h5>
                        <div class="bancos-debito">
                            <span class="caixa"></span>
                            <span class="bradesco"></span>
                            <span class="banrisul"></span>
                            <span class="santander"></span>
                            <span class="itau"></span>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-4 col-md-6">
                        <div class="ambiente-de-compra">
                            <h5>ambiente de compra seguro</h5>
                            <p>CERTIFICADO OFICIAL</p>
                            <span class="logo-app-spider">app spider</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="rodape">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                    <span class="mini-logo">
                        <img src="{{ asset('front/images/logo_folhadirigida2.png') }}" alt="">
                    </span>

                        <span class="direitos-autorais">
                        &copy; 2000-2018 . Todos os direitos reservados.
                    </span>
                    </div>
                </div>
            </div>
        </section>
    </footer>

    <script type="text/javascript">
        $(function () {

            $('.selector').on('click', function () {
                var type = $(this).attr('type');
                $('.method_payment').val(type);
                $('.selector').removeClass('selected');
                $(this).addClass('selected');

                $('.boleto, .cartao, .endereco').hide();

                if(type === "boleto"){
                    $('.endereco').show();
                    $('.boleto').show();
                }else{
                    $('.cartao').show();
                }
            });

            $('#card_type').on('change', function (){
                if($(this).val() === 'new'){
                    $('.row.new_card').show();
                    $('#numero_cartao').attr('required', true);
                    $('#validade_cartao').attr('required', true);
                    $('#nome_cartao').attr('required', true);
                    $('#cvv_cartao').attr('required', true);
                }else{
                    $('.row.new_card').hide();
                    $('#numero_cartao').removeAttr('required');
                    $('#validade_cartao').removeAttr('required');
                    $('#nome_cartao').removeAttr('required');
                    $('#cvv_cartao').removeAttr('required');
                }
            });

            var method_payment = $('.method_payment').val();

            if(method_payment === "boleto"){
                $('.endereco').show();
                $('.boleto').show();
            }else{
                $('.cartao').show();
            }

            function limpa_formulario_cep() {
                // Limpa valores do formulário de cep.
                $('[name="endereco"]').val("");
                $('[name="bairro"]').val("");
                $('[name="cidade"]').val("");
                $('[name="estado"]').val("");
                $('[name="complemento"]').val("");
            }

            $(".formatCEP").inputmask("99999-999");
            $(".formatCREDIT").inputmask("9999-9999-9999-9999");
            $(".formatVALIDATE").inputmask("99/9999");

            //Quando o campo cep perde o foco.
            $('.buscaCEP').blur(function(){
                var cep = $(this).val().replace(/\D/g, '');

                if (cep != "") {
                    var validacep = /^[0-9]{8}$/;

                    if(validacep.test(cep)) {
                        $('[name="endereco"]').val("Carregando...").focus();
                        $('[name="bairro"]').val("Carregando...").focus();
                        $('[name="cidade"]').val("Carregando...").focus();
                        $('[name="estado"]').val("...").focus();
                        $('[name="complemento"]').val("Carregando...").focus();
                        $('[name="numero"]').focus();

                        //Consulta o webservice viacep.com.br/
                        $.getJSON("//viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                            if (!("erro" in dados)) {
                                $('[name="endereco"]').val(dados.logradouro);
                                $('[name="bairro"]').val(dados.bairro);
                                $('[name="cidade"]').val(dados.localidade);
                                $('[name="estado"]').val(dados.uf);
                                $('[name="complemento"]').val(dados.complemento);
                            }
                            else {
                                limpa_formulario_cep();
                                alert("CEP não encontrado.");
                            }
                        });
                    }
                    else {
                        //cep é inválido.
                        limpa_formulario_cep();
                        alert("Formato de CEP inválido.");
                    }
                }
                else {
                    //cep sem valor, limpa formulário.
                    limpa_formulario_cep();
                }
            });
        });
    </script>

@endsection