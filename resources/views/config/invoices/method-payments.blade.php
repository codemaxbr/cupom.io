@extends('layouts.sistema')
@section('content')

    <!-- Page Title Area -->
    <div class="row page-title clearfix">
        <div class="page-title-left">
            <h6 class="page-title-heading mr-0 mr-r-5">Configurações</h6>
            <!--<p class="page-title-description mr-0 d-none d-md-inline-block">statistics, charts and events</p>-->
        </div>
        <!-- /.page-title-left -->
        <div class="page-title-right d-none d-sm-inline-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Configurações</li>
            </ol>
        </div>
        <!-- /.page-title-right -->
    </div>
    <!-- /.page-title -->

    <div class="row">
        <!-- col-md-4 -->
        <div class="actions-sidebar mr-t-10 pd-l-0 pd-r-20">
            <div class="widget-bg widget-notes border-radius-3">
                <div class="widget-body profile-user-description p-3">
                    <h6 class="mr-t-0">
                        Financeiro
                    </h6>

                    <div class="contact-details-cell text-left">
                        <p class="mr-b-0 w-100">
                            <a href="{{ route('config.method-payment') }}" class="fw-600 fs-15 d-block">
                                <i class="icone-right-dir f-left"></i>
                                Método de pagamento
                            </a>
                            Você pode selecionar um gateway padrão para cada tipo de pagamento.
                        </p>
                    </div>

                    <div class="contact-details-cell text-left">
                        <p class="mr-b-0 w-100">
                            <a href="#" class="fw-600 fs-15 d-block">
                                <i class="icone-right-dir f-left"></i>
                                Faturas
                            </a>
                            Selecione como e quando serão feitas os envios de cobrança para o cliente.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- col-md-4 -->

        <div class="content-with-sidebar">
            <form action="{{ route('config.store.method-payment') }}" method="post">
                @csrf
                <!-- Formulário -->
                <div class="formulario mr-t-10 bg-white p-3 border-radius-3">
                    <h6 class="mr-b-10 mr-t-0">
                        <i class="icone-barcode"></i>
                        Meios de pagamento preferenciais
                    </h6>

                    <p class="mr-b-10">
                        As formas de pagamento que se encontram na lista estão disponíveis para uso. Sendo assim, serão exibidas apenas as opções de gateways já cadastrados.
                    </p>

                    <div class="alert alert-info mr-b-10">
                        <b>Importante: </b>O gateway precisar estar habilitado para fazer transações com checkout transparente.
                    </div>

                    <!-- Email de Boas-vindas -->
                    <div class="row">
                        <div class="col-md-4 noPadding">
                            <label for="email_template">Boleto Bancário</label>
                            <select name="boleto_gateway" id="email_template" class="form-control selectpicker" required>
                                @forelse($modules as $module)

                                    <option value="{{ $module->module->id }}" @if(getOption('boleto_gateway') == $module->module->id && !is_null(getOption('boleto_gateway'))) selected @endif>{{ $module->module->name }}</option>
                                @empty
                                    <option value="">Nenhum</option>
                                @endforelse
                            </select>
                        </div>

                        <div class="col-md-4 noPadding">
                            <label for="email_template">Cartão de crédito</label>
                            <select name="cartao_gateway" id="email_template" class="form-control selectpicker" required>
                                @forelse($modules as $module)

                                    <option value="{{ $module->module->id }}" @if(getOption('cartao_gateway') == $module->module->id && !is_null(getOption('cartao_gateway'))) selected @endif>{{ $module->module->name }}</option>
                                @empty
                                    <option value="">Nenhum</option>
                                @endforelse
                            </select>
                        </div>

                        <div class="col-md-3 noPadding">
                            <label for="email_template">Depósito em conta</label>
                            <select name="permitir_deposito" id="email_template" class="form-control selectpicker">
                                <option value="0" @if(getOption('permitir_deposito') == '0' && !is_null(getOption('permitir_deposito'))) selected @endif>Não</option>
                                <option value="1" @if(getOption('permitir_deposito') == '1' && !is_null(getOption('permitir_deposito'))) selected @endif>Sim</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- / Formulário -->

                <!-- Formulário -->
                <div class="formulario bg-white p-3 border-radius-3 mr-t-20">
                    <h6 class="mr-b-10 mr-t-0">
                        <i class="icone-dollar"></i>
                        Contas bancárias habilitadas para depósito
                    </h6>

                    <p class="mr-b-10">
                        Informe aqui quais são as contas bancárias que você possui e estão habilitadas para depósito.
                    </p>


                    <div class="row">
                        <div class="col-md-12 noPadding">
                            @if(!empty($banks))
                                <table class="table table-hover">
                                    <tbody>
                                    @foreach($banks as $bank)
                                        <tr>
                                            <td>
                                                <div class="conta">
                                                    <img src="{{ asset('images/bancos/'.$bank->bank.'.png') }}" alt="">
                                                    <b>
                                                        @switch($bank->bank)
                                                            @case('bradesco') Bradesco @break
                                                            @case('itau') Itaú @break
                                                            @case('caixa') Caixa Econômica @break
                                                            @case('bb') Banco do Brasil @break
                                                            @case('santander') Santander @break
                                                        @endswitch
                                                    </b>
                                                    <small>Agência: <strong class="mr-r-10">{{ $bank->agency }}</strong> Conta Corrente: <strong>{{ $bank->account }}-{{ $bank->digit }}</strong></small>
                                                    <small>Cedente: <strong>{{ $bank->owner }}</strong></small>
                                                </div>
                                            </td>
                                            <td>Criado em {{ $bank->created_at->format('d/m/Y H:i') }}</td>
                                            <td class="text-right">
                                                <a href="#" class="link-btn">
                                                    <i class="icone-pencil"></i>
                                                    Editar
                                                </a>

                                                <a href="#" class="link-btn mr-l-10">
                                                    <i class="icone-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @endif

                            <button type="button" data-toggle="modal" data-target="#novaConta" class="btn btn-xs btn-default fs-14">Adicionar conta</button>
                        </div>
                    </div>
                </div>
                <!-- / Formulário -->


                <div class="buttons mr-t-20">
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-sm btn-primary fs-14">
                                Salvar configurações
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Nova Conta -->
    <div class="modal fade" id="novaConta" tabindex="-1" role="dialog" aria-labelledby="novaConta_label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="width: 400px;">
                <form action="{{ route('config.store.conta-bancaria') }}" method="post">
                @csrf
                    <div class="modal-body p-0">

                        <div class="col-md-12 pd-lr-20 pd-t-0">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

                            <h4 class="modal-title d-inline" id="mExcluirLabel">
                                <span class="plugin-title d-inline-block mr-t-10 fs-20">Nova conta</span>
                            </h4>

                            <div class="row">
                                <div class="col-md-2 noPadding-right">
                                    <img src="{{ asset('/images/bancos/bradesco.gif') }}" class="img-responsive img-banco" style="margin-top: 5px;" />
                                </div>

                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="banco" class="mr-b-0">
                                            Banco
                                        </label>
                                        <select id="banco" name="banco" required class="form-control selectpicker">
                                            <option value="">Selecione o banco</option>
                                            <option value="bradesco">Bradesco</option>
                                            <option value="itau">Itaú</option>
                                            <option value="caixa">Caixa Econômica</option>
                                            <option value="santander">Santander</option>
                                            <option value="bb">Banco do Brasil</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="nome" class="mr-b-0">Cedente</label>
                                        <input name="cedente" required class="form-control" type="text" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="nome" class="mr-b-0">Carteira <a href="#"><i class="icone-help-circled-1 mr-l-5"></i></a></label>
                                        <input name="carteira" required class="form-control" type="text" />
                                    </div>
                                </div>

                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="tipo_conta" class="mr-b-0">Tipo de Conta</label>
                                        <select id="tipo_conta" required name="tipo_conta" class="form-control selectpicker">
                                            <option value="">Selecione o tipo</option>
                                            <option value="corrente">Conta corrente</option>
                                            <option value="poupanca">Conta Poupança</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="agencia" class="mr-b-0">Agência</label>
                                        <input id="agencia" name="agencia" required class="form-control" type="text" placeholder="" />
                                    </div>
                                </div>

                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="conta" class="mr-b-0">Conta</label>
                                        <input id="conta" name="conta" required class="form-control" type="text" placeholder="" />
                                    </div>
                                </div>

                                <div class="col-md-2 noPadding">
                                    <div class="form-group">
                                        <label></label>
                                        <input name="digito" required class="form-control" type="text" />
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-default fs-14" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-sm btn-primary fs-14">Salvar conta</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <script type="text/javascript">
        $(function (){
            $('#banco').on('change', function () {
                var banco = $(this).val();
                $('img.img-banco').attr('src', '{{ asset('/images/bancos/_banco_.png') }}'.replace('_banco_', banco));
            });
        })
    </script>

@endsection