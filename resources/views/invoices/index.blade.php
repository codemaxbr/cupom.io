@extends('layouts.sistema')

@section('content')

    <!-- Page Title Area -->
    <div class="row page-title clearfix">
        <div class="page-title-left">
            <h6 class="page-title-heading mr-0 mr-r-5">Faturas</h6>
            <!--<p class="page-title-description mr-0 d-none d-md-inline-block">statistics, charts and events</p>-->
        </div>
        <!-- /.page-title-left -->
        <div class="page-title-right d-none d-sm-inline-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">Financeiro</a>
                </li>
                <li class="breadcrumb-item active">Fatura</li>
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

    <div class="alert alert-success" id="deleteJSON" style="display: none;">
        <i class="icone-ok-3"></i>
        Os <b class="qtd_select"></b> clientes selecionados foram excluídos.
    </div>

    <div class="widget-list">
        <div class="row">

            <!-- Widget = Clientes Ativos -->
            <div class="widget-holder widget-sm col-md-2">
                <div class="widget-bg">
                    <div class="widget-body lh-10 pd-10">
                        <div class="counter-w-info media">
                            <div class="media-body">
                                <p class="mr-b-5">Total em atraso</p>
                                <span class="counter-title text-red fs-20">
                                    <strong>R$ {{ numFormat($total_overdue) }}</strong>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Widget = Clientes Ativos -->
            <div class="widget-holder widget-sm col-md-2">
                <div class="widget-bg">
                    <div class="widget-body lh-10 pd-10">
                        <div class="counter-w-info media">
                            <div class="media-body">
                                <p class="mr-b-5">Total pendente</p>
                                <span class="counter-title text-dark fs-20">
                                    <strong>R$ {{ numFormat($total_pending) }}</strong>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Widget = Clientes Ativos -->
            <div class="widget-holder widget-sm col-md-2">
                <div class="widget-bg">
                    <div class="widget-body lh-10 pd-10">
                        <div class="counter-w-info media">
                            <div class="media-body">
                                <p class="mr-b-5">Total pago</p>
                                <span class="counter-title text-green fs-20">
                                    <strong>R$ {{ numFormat($total_paid) }}</strong>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Widget = Clientes Ativos -->
            <div class="widget-holder widget-sm col-md-6">
                <div class="widget-bg">
                    <div class="widget-body lh-10 pd-10">
                        <div class="counter-w-info media">
                            <div class="media-body">
                                <p class="mr-b-5">Previsão do mês</p>
                                <span class="counter-title text-dark fs-20">
                                    <b>R$ {{ numFormat($total_income) }}</b>
                                </span>

                                <span class="counter-title pull-right text-dark fs-25" style="margin-top: -5px; letter-spacing: -0.5px;">
                                    {{ mesExtenso() }}<strong class="text-muted">/{{ date('Y') }}</strong>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="widget-holder col-md-12 mr-t-5">

                <div class="widget-bg">
                    <div class="widget-body">

                        <div class="mail-inbox-header">
                            <div class="col-md-6">

                                <div class="mail-inbox-tools d-flex align-items-center">

                                    <div class="d-none d-sm-block text-right mr-r-20">
                                        <a href="{{ route('invoices.view.add') }}" class="btn btn-primary btn-sm fs-14">
                                            <i class="icone-doc-new"></i>
                                            Emitir nova cobrança
                                        </a>
                                    </div>

                                    <div class="btn-group">
                                        <a href="{{ route('customers.view.import') }}" class="btn btn-sm btn-link mr-2 fs-14">
                                            <i class="list-icon fs-18 mr-r-5 fa fa-download" style="margin-top: 5px;"></i> <strong>Exportar</strong>
                                        </a>

                                        <div class="dropdown">
                                            <a href="javascript:void(0)" data-toggle="dropdown" class="btn btn-sm fs-14 fw-semibold btn-link dropdown-toggle headings-color">
                                                <i class="feather feather-more-vertical text-muted fs-18 mr-2"></i> Ações
                                            </a>
                                            <div role="menu" class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="javascript:void(0)">Enviar Lembrete</a>
                                                <a class="dropdown-item" href="javascript:void(0)">Gerar cupom</a>
                                                <a class="dropdown-item" href="javascript:void(0)">Converter em Pedido</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item text-red" href="javascript:void(0)">Remover</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-6">
                                        <div class="form-input-icon">
                                            <i class="fa fa-calendar list-icon"></i>
                                            <input class="form-control daterange" id="l6" placeholder="Período" type="text">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-sm btn-block btn-primary fs-14">Buscar</button>
                                    </div>

                                    <div class="col-md-3">
                                        <a class="btn btn-sm btn-link bt_searchAdvanced fs-14">
                                            <i class="mr-r-5 fa fa-caret-down"></i>
                                            Busca avançada
                                        </a>
                                    </div>
                                </div>
                                <!-- /.mail-inbox-tools -->
                            </div>
                        </div>

                        <div class="row">
                            <div class="search-advanced arrow-up" style="display: none;">
                                <form action="{{ route('invoice.search.advanced') }}" method="get">
                                    {{ csrf_field() }}

                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="situation">Situação</label>
                                                <select name="situation" id="situation" class="form-control selectpicker">
                                                    <option value="">Selecione</option>
                                                    <option value="0">Pendente</option>
                                                    <option value="1">Pago</option>
                                                    <option value="2">Cancelado</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="email">Cliente</label>
                                                <input type="text" id="cliente" name="cliente" class="form-control" placeholder="Digite o nome do cliente..."/>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="telefone">Vencimento</label>
                                                <input type="text" id="vencimento" name="vencimento" class="form-control datepicker" />
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <button type="submit" class="btn btn-primary btn-search-advanced">
                                                <i class="list-icon feather feather-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>

                        <form method="post" id="lista_cadastros">
                            {{ csrf_field() }}
                            <table class="table table-hover" id="tabela_clientes">
                                <thead>
                                <tr>
                                    <th class="txt-center" style="width: 15px;">
                                        <input type="checkbox" class="selecionaTodos">
                                    </th>
                                    <th>Nº da Fatura</th>
                                    <th>Emitida em</th>
                                    <th>Cliente</th>
                                    <th>Situação</th>
                                    <th>Vencimento</th>
                                    <th class="text-right">Valor</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($invoices as $invoice)
                                    <tr>
                                        <td>
                                            <input name="id" class="td_item" value="{{ $invoice->id }}" type="checkbox">
                                        </td>
                                        <td>
                                            <a href="{{ route('invoice.view', $invoice->uuid) }}">#{{ $invoice->id }}</a>
                                        </td>
                                        <td>{{ $invoice->created_at->format('d/m/Y H:i') }}</td>
                                        <td>{{ $invoice->customer->name }}</td>
                                        <td>
                                            @if($invoice->status == 0)
                                                <strong class="text-orange">
                                                    <i class="icone-clock"></i>
                                                    Pendente
                                                </strong>
                                            @endif

                                            @if($invoice->status == 1)
                                                <strong class="text-green">
                                                    <i class="icone-ok-3"></i>
                                                    Pago
                                                </strong>
                                            @endif

                                            @if($invoice->status == 2)
                                                <strong class="text-danger">
                                                    <i class="icone-attention-circled"></i>
                                                    Em Atraso
                                                </strong>
                                            @endif

                                            @if($invoice->status == 3)
                                                <strong class="text-dark">
                                                    <i class="icone-block"></i>
                                                    Cancelado
                                                </strong>
                                            @endif
                                        </td>
                                        <td>{{ $invoice->due->format('d/m/Y') }}</td>
                                        <td class="text-right">R$ {{ numFormat($invoice->total) }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </form>

                        <div class="row">
                            <div class="col-md-7 mt-1 pd-l-10">
                            <span class="headings-font-family">
                                Exibindo de {{ $invoices->firstItem() }} à {{ $invoices->lastItem() }} de <b>{{ $invoices->total() }}</b> registros
                            </span>
                            </div>

                            <div class="col-md-5">
                                <div class="btn-group float-right">
                                    {{ $invoices->links() }}
                                </div>
                            </div>
                        </div>


                    </div>
                    <!-- /.widget-body -->
                </div>
                <!-- /.widget-bg -->
            </div>
            <!-- /.widget-holder -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.widget-list -->



    <!-- Modal -->
    <div class="modal fade" id="modalExcluir" tabindex="-1" role="dialog" aria-labelledby="mExcluirLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="mExcluirLabel">
                        <i class="icone-trash"></i>
                        <span class="tit_cliente">Excluir Cliente</span>
                    </h4>
                </div>

                <div class="modal-body" id="verCliente" style="background: #fff">
                    <p class="msg_modal">
                        Tem certeza que deseja <b>excluir</b> o(s) <b class="qtd_select"></b> cliente(s) selecionado(s)?
                    </p>

                    <div class="alert alert-warning">
                        Você não terá mais acesso a <b>Histórico Financeiro</b>, <b>Serviços Contratados</b> e <b>Tickets de Suporte</b> deste(s) cliente(s).
                    </div>

                    <b class="color-red">
                        <i class="icone-attention"></i>
                        ESTA OPERAÇÃO É IRREVERSÍVEL
                    </b>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-danger" rel="submitDel_cliente">
                        <i class="icone-trash"></i>
                        Excluir
                    </a>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- InputMask -->
    <script src="{{ asset('plugins/input-mask/jquery.inputmask.js') }}"></script>
    <script src="{{ asset('plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
    <script src="{{ asset('plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>

    <!-- Incluindo o JavaScript -->
    <script type="text/javascript" src="{{ asset('js/widgets/invoices.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/widgets/clientes.js') }}"></script>
    <script type="text/javascript">
        function buscaCliente(modulo){
            $.ajax({
                type: 'GET',
                url: '/painel/clientes/buscar/'+modulo,
                dataType: 'html',
                success: function(data){
                    $('#abreModal').modal('show');
                    $('.modal-dialog').animate().width('750px');
                    $('.modal-content').html(data);
                },
                error: function(error){
                    $('#abreModal').modal('show');
                    $('.modal-dialog').animate().width('650px');
                    $('.modal-content').html(error.responseText);
                }
            });
        }
    </script>
@endsection