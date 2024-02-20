@extends('layouts.sistema')
@section('content')

    <!-- Page Title Area -->
    <div class="row page-title clearfix">
        <div class="page-title-left">
            <h6 class="page-title-heading mr-0 mr-r-5">Emitir nova cobrança</h6>
        </div>

        <!-- Breadcrumb -->
        <div class="page-title-right d-none d-sm-inline-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.html">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="index.html">Financeiro</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="index.html">Faturas</a>
                </li>
                <li class="breadcrumb-item active">Novo</li>
            </ol>
        </div>
    </div>

    <form class="widget-list" id="config-plans-add" method="post" action="{{ route('invoices.create') }}">
        @csrf
        <div class="row">
            <div class="content-with-sidebar">
                <!-- Cliente -->
                <div class="formulario bg-white p-3 border-radius-3">
                    <h6 class="mr-b-20 mr-t-0">
                        <i class="icone-user-1"></i>
                        Destinatário
                    </h6>

                    <div class="row">
                        <div class="col-md-3 noPadding text-right">
                            <label for="customer">Cliente <b class="text-red">*</b></label>
                        </div>
                        <div class="col-md-7 form-group">
                            <select name="customer" id="customer" class="form-control selectClientes"></select>
                        </div>
                    </div>
                </div>
                <!-- / Cliente -->

                <!-- Detalhes do documento -->
                <div class="formulario mr-t-20 bg-white p-3 border-radius-3">
                    <h6 class="mr-b-20 mr-t-0">
                        <i class="icone-info-1"></i>
                        Detalhes do documento
                    </h6>

                    <div class="row">
                        <div class="col-md-3 noPadding text-right">
                            <label for="emissao">Data de Emissão <b class="text-red">*</b></label>
                        </div>
                        <div class="col-md-3 form-group">
                            <div class="input-group input-has-value">
                                <input type="text" name="emissao" id="emissao" class="form-control datepicker" required value="{{ \Carbon\Carbon::today()->format('d/m/Y') }}">
                                <span class="input-group-addon">
                                    <i class="icone-calendar"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 noPadding text-right">
                            <label for="vencimento">Data de Vencimento <b class="text-red">*</b></label>
                        </div>
                        <div class="col-md-3 form-group">
                            <div class="input-group input-has-value">
                                <input type="text" name="vencimento" id="vencimento" class="form-control" required value="{{ \Carbon\Carbon::today()->format('d/m/Y') }}">
                                <span class="input-group-addon">
                                    <i class="icone-calendar"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 noPadding text-right">
                            <label for="type_invoice">Tipo <b class="text-red">*</b></label>
                        </div>
                        <div class="col-md-3 form-group">
                            <select name="type_invoice" id="type_invoice" class="form-control selectpicker">
                                @foreach($tipos_fatura as $tipo)
                                    <option value="{{ $tipo->id }}">{{ $tipo->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 noPadding text-right">
                            <label for="nome">Motivo da Cobrança</label>
                        </div>
                        <div class="col-md-7 form-group">
                            <input type="text" name="motivo" class="form-control" placeholder="Opcional">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 noPadding text-right">
                            <label for="nome">Observações</label>
                        </div>
                        <div class="col-md-7 form-group">
                            <textarea class="form-control" name="obs" style="height: 110px; resize: none;" placeholder="Opcional"></textarea>
                        </div>
                    </div>

                    <hr />

                    <div class="row">
                        <div class="col-md-3 noPadding text-right">
                            <label for="taxas">Taxas e Impostos</label>
                        </div>
                        <div class="col-md-3 form-group">
                            <input type="text" name="taxas" id="taxas" class="form-control ls-price" placeholder="Opcional">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 noPadding text-right">
                            <label for="desconto">Desconto</label>
                        </div>
                        <div class="col-md-3 form-group">
                            <input type="text" name="desconto" id="desconto" class="form-control ls-price" placeholder="Opcional">
                        </div>
                    </div>

                </div>
                <!-- / Detalhes do documento -->

                <!-- Itens -->
                <div class="formulario mr-t-20 bg-white p-3 border-radius-3">
                    <h6 class="mr-b-20 mr-t-0">
                        <i class="fa fa-shopping-cart list-icon mr-r-5"></i>
                        Itens à faturar
                    </h6>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="itens_fatura"></div>

                            <div class="enderecos fatura_itens">
                                <table class="table table-bordered table-striped" width="100%">
                                    <thead>
                                    <tr class="bg-primary-dark text-white">
                                        <th>Tipo</th>
                                        <th>Descrição</th>
                                        <th class="text-center">Preço</th>
                                        <th class="text-center">Desconto</th>
                                        <th class="text-center">Qtd.</th>
                                        <th class="text-center">Subtotal</th>
                                    </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>

                            <div class="botoes_incluir">
                                <div class="well">
                                    Por enquanto, nenhum item para faturar
                                </div>

                                <a class="btn btn-primary btn-xs fs-14" data-toggle="modal" rel="adicionarItem">
                                    <i class="icone-plus-1"></i>
                                    Adicionar Item
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-5" style="padding-top: 20px;"></div>

                        <input type="hidden" class="inputTotal" name="total" />

                        <div class="col-md-7 invoice-sum text-right">
                            <ul class="list-unstyled">
                                <li class="sub-total">Subtotal: <span class="valor txtSubtotal">R$ 0,00</span></li>
                                <li class="taxa">Desconto (-): <span class="valor txtDesconto">R$ 0,00</span></li>
                                <li class="desconto">Taxas e Impostos (+): <span class="valor txtTaxas">R$ 0,00</span></li>
                                <li class="total fs-20 text-dark"><strong>Total: <span class="valor txtTotal">R$ 0,00</span></strong>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <input type="hidden" name="account_id" id="account_id" value="{{ AccountId() }}">

                    <div class="row" style="margin-top: 20px;">
                        <div class="col-md-12 text-right">
                            <a class="btn btn-sm btn-default fs-14 mr-r-5 text-dark">
                                <i class="fa fa-arrow-left mr-r-5"></i>
                                Voltar para lista de faturas
                            </a>

                            <button type="submit" class="btn btn-sm btn-primary fs-14">
                                <i class="icone-ok"></i>
                                Emitir cobrança
                            </button>
                        </div>
                    </div>
                </div>
                <!-- / Itens -->
            </div>

            <!-- User Actions -->
            <div class="actions-sidebar">
                <!-- Endereços -->
                <div class="widget-bg widget-notes border-radius-3">
                    <div class="widget-body profile-user-description p-3">
                        <h6 class="mr-t-0">
                            <i class="icone-question fs-20"></i>
                            Ajuda
                        </h6>

                        <div class="contact-details-cell text-left">
                            <p class="mr-b-0 w-100">
                                <small class="heading-font-family fw-500">Campos Obrigatórios</small><br />
                                Fique atento aos dados CPF, CNPJ, Data de Nascimento e E-mail. Estes dados são obrigatórios para evitar qualquer tipo de problema com cadastros inválidos ou SPAM.
                            </p>
                        </div>

                        <div class="contact-details-cell text-left">
                            <p class="mr-b-0 w-100">
                                <small class="heading-font-family fw-500">E-mail Autenticado</small><br />
                                Todas as operações com interação do cliente será enviado uma notificação por e-mail para acompanhamento e validação.
                                <br /><br />
                                Se o e-mail digitado for inválido, o cadastro será desativado em 48h.
                            </p>
                        </div>
                    </div>
                </div>
                <!-- ./ Endereços -->
            </div>
        </div>
    </form>

    @include('invoices.add_item')


<!-- Datepicker -->
<script src="{{ asset('plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('plugins/datepicker/locales/bootstrap-datepicker.pt-BR.js') }}"></script>

<!-- InputMask -->
<script src="{{ asset('plugins/input-mask/jquery.inputmask.js') }}"></script>
<script src="{{ asset('plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
<script src="{{ asset('plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>

<script type="text/javascript" src="{{ asset('js/functions/invoices.js') }}"></script>
@endsection