@extends('layouts.sistema')
@section('content')

<!-- Page Title Area -->
<div class="row page-title clearfix">
    <div class="page-title-left">
        <h6 class="page-title-heading mr-0 mr-r-5">Detalhes da Fatura</h6>
        <p class="page-title-description mr-0 d-none d-md-inline-block">#{{ $invoice->id }}</p>
    </div>
    <!-- /.page-title-left -->
    <div class="page-title-right d-none d-sm-inline-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./index.html">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">E-Commerce Invoice</li>
        </ol>
    </div>
    <!-- /.page-title-right -->
</div>
<!-- /.page-title -->

@if (session('success'))
    <div class="alert alert-success">
        <i class="icone-ok-3"></i>
        {{ session('success') }}
    </div>
@endif

@if (session('status'))
    <div class="alert alert-success">
        <i class="icone-ok-3"></i>
        {{ session('status') }}
    </div>
@endif

@if (session('deleted'))
    <div class="alert alert-success">
        <i class="icone-ok-3"></i>
        O(A) cliente <b>{{ session('deleted') }}</b> foi excluído(a).
    </div>
@endif
<!-- =================================== -->
<!-- Different data widgets ============ -->
<!-- =================================== -->
<div class="widget-list">
    <div class="row">

        <div class="content-with-sidebar">
            <div class="widget-bg">
                <div class="widget-body clearfix">
                    <div class="ecommerce-invoice">
                        <div class="d-block">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="f-left m-0 d-inline-block">
                                        Fatura Nº {{ $invoice->id }}
                                    </h3>

                                    <a href="#" class="btn btn-xs btn-primary mr-l-15 p-1 f-left fs-14">
                                        <i class="icone-print"></i>
                                    </a>

                                    <a href="#" class="btn btn-xs btn-primary mr-l-5 p-1 f-left fs-14">
                                        <i class="icone-download"></i>
                                    </a>
                                </div>
                                <div class="col-md-6 text-right">
                                    @if($invoice->status == 0)
                                        <strong class="text-orange fs-18">
                                            <i class="icone-clock"></i>
                                            Pendente
                                        </strong>
                                    @endif

                                    @if($invoice->status == 1)
                                        <strong class="text-green fs-18">
                                            <i class="icone-ok-3"></i>
                                            Pago
                                        </strong>
                                    @endif

                                    @if($invoice->status == 2)
                                        <strong class="text-danger fs-18">
                                            <i class="icone-attention-circled"></i>
                                            Em Atraso
                                        </strong>
                                    @endif

                                    @if($invoice->status == 3)
                                        <strong class="text-dark fs-18">
                                            <i class="icone-block"></i>
                                            Cancelado
                                        </strong>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <hr />
                        <!-- /.row -->

                        @if($invoice->status == 3)
                            <div class="alert alert-danger">
                                <i class="icone-info-circled"></i>
                                <b>Observação: </b>
                                @if($invoice->obs != null)
                                    {{ $invoice->obs }}
                                @else
                                    Motivo não espicificado.
                                @endif
                            </div>
                        @endif

                        @if($invoice->status == 1 && $invoice->statement != null)
                            <div class="alert alert-success">
                                @if($invoice->statement->user != null)
                                    <b>Marcado como Pago</b> com {{ $invoice->statement->type_payment->name }} em {{ $invoice->statement->created_at->format('d/m/Y H:i') }}.<br />
                                    <b>Por</b>: {{ $invoice->statement->user->name }} - {{ $invoice->statement->user->email }}.
                                    @if($invoice->attachment != null)
                                        <a target="_blank" class="btn btn-default btn-xs fs-14" href="{{ $invoice->attachment->file_url }}">
                                            Comprovante anexado
                                        </a>
                                    @endif
                                @else
                                    <b>Pagamento confirmado pelo sistema</b> com {{ $invoice->statement->type_payment->name }} em {{ $invoice->statement->created_at->format('d/m/Y H:i') }}.<br />
                                @endif
                            </div>
                        @endif

                        <div class="d-block">
                            <div class="row">
                                <div class="col-md-6 text-dark">
                                    <h6 class="mr-t-0">Dados do cliente</h6>
                                    {{ $invoice->customer->name }}
                                    <br />{{ $invoice->customer->cpf_cnpj }}
                                    <br />{{ $invoice->customer->email }}
                                </div>

                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="invoice-details-date text-center">
                                                <h6>Vencimento</h6>
                                                <span class="date fs-20">
                                                <i class="icone-calendar"></i>
                                                    {{ $invoice->due->format('d/m/Y') }}
                                            </span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="invoice-details-date text-center">
                                                <h6>Tipo de cobrança</h6>
                                                <span class="date fs-20 text-dark fw-600">
                                                {{ $invoice->type_invoice->name }}
                                            </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr />

                        <h6 class="mr-t-0">Produtos / Serviços</h6>

                        <table class="table table-bordered table-striped">
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
                            <tbody class="text-dark">
                                @foreach($invoice->invoice_items as $item)
                                <tr>
                                    <td>{{ $item->type_plan->name }}</td>
                                    <td>
                                        <a href="{{ $item->plan->id }}">{{ $item->plan->name }}</a>
                                        @if($item->domain != null)
                                            {{ $item->domain }}
                                        @endif
                                    </td>
                                    <td class="text-center">R$ {{ numFormat($item->price) }}</td>
                                    <td class="text-center">R$ {{ numFormat($item->discount) }}</td>
                                    <td class="text-center">{{ $item->qty }}</td>
                                    <td class="text-center">R$ {{ numFormat($item->price * $item->qty - $item->discount) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-md-8" style="line-height: 1.4;">
                                <h6>Observações</h6>
                                <li class="mr-b-10">Se o pagamento não for efetuado até <b>{{ $invoice->due->format('d/m/Y') }}</b>, o serviço será automaticamente <b>suspenso</b>.</li>
                                <li>Caso o pagamento já tenha sido efetuado, aguarde a confirmação automática do sistema em até 2 dias úteis.</li>
                            </div>

                            <div class="col-md-4 invoice-sum text-right">
                                <ul class="list-unstyled">
                                    <li>Subtotal: R$ {{ numFormat($subtotal) }}</li>
                                    <li>Desconto (-): R$ {{ numFormat($invoice->discount) }}</li>
                                    <li>Taxas e Impostos (+): R$ {{ numFormat($invoice->fee) }}</li>
                                    <li class="fs-18 text-dark fw-600">
                                        Total: R$ {{ numFormat($subtotal - $invoice->discount + $invoice->fee) }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.ecommerce-invoice -->
                </div>
                <!-- /.widget-body -->
            </div>
            <!-- /.widget-bg -->

            <!-- Faturas -->
            <div class="faturas mr-t-20 bg-white p-3 border-radius-3">
                <h6 class="mr-b-20 mr-t-0">
                    <i class="icone-clock"></i>
                    Histórico de atividades
                </h6>

                <table class="table table-hover mb-0">
                    <thead>
                        <tr class="thead-inverse bg-dark-contrast">
                            <th>Data</th>
                            <th>Descrição</th>
                            <th>Responsável</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-dark">
                            <td>24/10/2014 00:00</td>
                            <td>Pagamento não confirmado</td>
                            <td>Cliente</td>
                        </tr>

                        <tr class="text-dark">
                            <td>20/10/2014 10:36</td>
                            <td>Cobrança enviada para <b>lucas.codemax@yahoo.com.br</b></td>
                            <td>Sistema</td>
                        </tr>

                        <tr class="text-dark">
                            <td>20/10/2014 10:35</td>
                            <td>Pagamento via boleto aguardando confirmação</td>
                            <td>Sistema</td>
                        </tr>

                        <tr class="text-dark">
                            <td>20/10/2014 10:35</td>
                            <td>Cobrança criada no Fortunus</td>
                            <td>Sistema</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- / Faturas -->
        </div>
        <!-- /.widget-holder -->

        <!-- User Actions -->
        <div class="actions-sidebar">
            @if($invoice->status != 1 && $invoice->status != 3)
            <a href="#" data-toggle="modal" data-target=".modal-alterar-vencimento" class="btn btn-block btn-sm btn-primary fs-14">
                <i class="icone-calendar"></i>
                Alterar vencimento
            </a>

            <a href="#" data-toggle="modal" data-target=".modal-cancelar" class="btn btn-block btn-sm btn-default fs-14">
                <i class="icone-cancel"></i>
                Cancelar fatura
            </a>

            <a href="#" data-toggle="modal" data-target=".modal-marcar-pago" class="btn btn-block btn-sm btn-default fs-14">
                <i class="icone-ok-3"></i>
                Confirmar pagamento
            </a>

            <hr class="sep-dot" />

            <a href="#" class="btn btn-block btn-sm btn-default fs-14">
                <i class="icone-mail-3"></i>
                Enviar lembrete por e-mail
            </a>

            <hr class="sep-dot" />
            @endif

            <a href="#" data-toggle="modal" data-target=".modal-excluir" class="btn btn-block btn-sm btn-default color-red fs-14">
                <i class="icone-trash"></i>
                Remover
            </a>

            <!-- Endereços -->
            <div class="widget-bg widget-notes mr-t-20 border-radius-3">
                <div class="widget-body profile-user-description p-3">
                    <h6 class="mr-t-0">
                        <i class="fa fa-map-marker mr-r-5 fs-20"></i>
                        Endereço de Cobrança
                    </h6>

                    <div class="contact-details-cell text-left">
                        <p class="mr-b-0 w-100">
                            <small class="heading-font-family fw-500">Principal</small><br />
                            @if(!is_null($invoice->customer->address))
                                {{$invoice->customer->address->address}}
                                {{$invoice->customer->address->number}},
                                {{$invoice->customer->address->district}} -
                                {{$invoice->customer->address->city}}-
                                {{$invoice->customer->address->uf}} -
                                {{$invoice->customer->address->zipcode}}
                            @else
                                Sem dados de endereço
                            @endif
                        </p>
                    </div>
                </div>
            </div>
            <!-- ./ Endereços -->

            <!-- Cartões -->
            <div class="widget-bg widget-notes mr-t-20 border-radius-3">
                <div class="widget-body profile-user-description p-3">
                    <h6 class="mr-t-0">
                        <i class="fa fa-question mr-r-5 fs-20"></i>
                        Dica
                    </h6>

                    <div class="contact-details-cell text-left">
                        <p class="mr-b-0 w-100">
                            <small class="heading-font-family fw-500">Principal</small><br />
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores deserunt dolores enim molestiae nobis obcaecati quae repellendus, tenetur. Dolore doloremque molestiae sunt! Accusantium debitis facere fugiat placeat possimus. Doloremque, temporibus.
                        </p>
                    </div>
                </div>
            </div>
            <!-- ./ Cartões -->

        </div>

    </div>
    <!-- /.row -->
</div>
<!-- /.widget-list -->

<!-- Modal = Alterar Vencimento -->
<div class="modal modal-primary fade modal-alterar-vencimento" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel2" aria-hidden="true" style="display: none">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form action="{{ route('invoice.change.due', $invoice->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="modal-header text-inverse">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h5 class="modal-title" id="mySmallModalLabel2">Alterar vencimento</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group input-has-value">
                        <label class="form-control-label">Selecione uma data de vencimento</label>
                        <div class="input-group input-has-value">
                            <input type="text" name="due" class="form-control datepicker2" value="{{ $invoice->due->format('d/m/Y') }}">
                            <span class="input-group-addon">
                            <i class="icone-calendar"></i>
                        </span>
                        </div>
                    </div>

                    <!--
                    <div class="alert alert-info mr-b-0">
                        A data de vencimento precisa ser igual ou posterior a data atual.
                    </div>
                    -->

                    <!--
                    <div class="alert alert-danger mr-b-0">
                        <b class="d-block">ERRO 30453</b>
                        A data de vencimento não pode ser alterada por uma falha técnica.
                    </div>
                    -->
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-xs fs-14">
                        Aplicar
                    </button>

                    <button type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-default btn-xs fs-14">
                        Cancelar
                    </button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Modal = Confirmar paamento -->
<div class="modal modal-primary fade modal-marcar-pago" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel2" aria-hidden="true" style="display: none">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="{{ route('invoice.change.paid', $invoice->id) }}" enctype="multipart/form-data" method="post">
                @csrf
                @method('PUT')
                <div class="modal-header text-inverse">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h5 class="modal-title" id="mySmallModalLabel2">Confirmar pagamento</h5>
                </div>
                <div class="modal-body text-dark">
                    <p>
                        "Marcar como pago" indica que você recebeu o valor da cobrança, mas não por meio do sistema.
                        É um ótimo recurso para manter sua gestão em dia mesmo se o cliente pagar em mãos.
                    </p>

                    <p class="fs-16 text-red">Total devedor: <b>R$ {{ numFormat($invoice->total) }}</b></p>
                    <p>Deseja confirmar esta ação para esta cobrança?</p>

                    <div class="form-group col-6 no-padding-left">
                        <label for="type_payment">Forma de pagamento <b class="text-red">*</b>:</label>
                        <select name="type_payment" id="type_payment" class="form-control selectpicker" required data-placeholder="Selecione">
                            <option value="">Selecione</option>
                            @foreach($type_payments as $payment)
                                <option value="{{ $payment->id }}">{{ $payment->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="obs">Observação <b class="text-red">*</b>:</label>
                        <textarea name="obs" id="obs" rows="4" class="form-control" required style="resize: none;"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="comprovante">Anexar Comprovante <b class="text-red">*</b>:</label>
                        <input type="file" name="comprovante" id="comprovante" required class="form-control p-0">
                        <small class="text-muted">Arquivos permitidos: *.JPG, *.PNG, *.PDF</small>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-xs fs-14">
                        Confirmar
                    </button>

                    <button type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-default btn-xs fs-14">
                        Cancelar
                    </button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Modal = Cancelar -->
<div class="modal modal-primary fade modal-cancelar" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel2" aria-hidden="true" style="display: none">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="{{ route('invoice.change.cancelled', $invoice->id) }}" method="post">
                @csrf
                @method('PUT')

                <div class="modal-header text-inverse">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h5 class="modal-title" id="mySmallModalLabel2">Cancelamento de fatura</h5>
                </div>
                <div class="modal-body text-dark">
                    <p>
                        Deseja confirmar o cancelamento desta cobrança?
                    </p>

                    <label for="motivo_cancelamento">Motivo:</label>
                    <textarea name="motivo_cancelamento" id="motivo_cancelamento" rows="4" class="form-control" style="resize: none;"></textarea>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-xs fs-14">
                        Confirmar
                    </button>

                    <button type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-default btn-xs fs-14">
                        Cancelar
                    </button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Modal = Excluir -->
<div class="modal modal-primary fade modal-excluir" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel2" aria-hidden="true" style="display: none">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="{{ route('invoice.remove', $invoice->id) }}" method="post">
                @csrf
                @method('DELETE')

                <div class="modal-header text-inverse">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h5 class="modal-title" id="mySmallModalLabel2">Remover cobrança</h5>
                </div>
                <div class="modal-body text-dark">
                    <p>
                        Deseja remover permanentemente esta cobrança?
                    </p>

                    @if($invoice->subscriptions->isNotEmpty())
                    <p class="text-red">
                        <i class="icone-attention"></i>
                        Esta fatura foi gerada automaticamente para uma assinatura recorrente ativa. Se você remover esta fatura, o sistema somente irá emitir outra cobrança no próximo ciclo.
                    </p>

                    <li class="text-red">A cobrança do mês atual não será contabilizado.</li>
                    <li class="text-red">A assinatura ativa do cliente, poderá ser automaticamente suspensa por falta de pagamento</li>
                    @endif

                    <!-- Se for um pedido
                    <p class="text-red">
                        <i class="icone-attention"></i>
                        Esta é uma fatura de pedido. Foi gerada a partir do checkout de contratação de planos e serviços.
                    </p>
                    <p class="text-red">
                        Se você remover esta fatura, o cliente não poderá finalizar a contratação dos planos/serviços selecionados.
                    </p>
                    <!-- fim pedido -->
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-xs fs-14">
                        Confirmar
                    </button>

                    <button type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-default btn-xs fs-14">
                        Cancelar
                    </button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<script type="text/javascript">
    $(function () {
        $('.datepicker2').datepicker({
            format: 'dd/mm/yyyy',
            startDate: '-0d',
            startView: '0',
            todayHighlight: true,
        });
    });
</script>
@endsection