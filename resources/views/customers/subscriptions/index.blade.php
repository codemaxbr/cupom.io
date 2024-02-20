@extends('layouts.sistema')

@section('content')

    <!-- Page Title Area -->
    <div class="row page-title clearfix">
        <div class="page-title-left">
            <h6 class="page-title-heading mr-0 mr-r-5">Assinaturas</h6>
            <!--<p class="page-title-description mr-0 d-none d-md-inline-block">statistics, charts and events</p>-->
        </div>
        <!-- /.page-title-left -->
        <div class="page-title-right d-none d-sm-inline-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">Dashboard</a>
                </li>

                <li class="breadcrumb-item">
                    <a href="{{ route('customers.index') }}">Clientes</a>
                </li>
                <li class="breadcrumb-item active">Assinaturas</li>
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

    @if (session('error'))
        <div class="alert alert-danger">
            <i class="icone-attention"></i>
            {{ session('error') }}
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
        Os <b class="qtd_select"></b> assinaturas selecionados foram excluídos.
    </div>

    <div class="widget-list">
        <div class="row">
            <div class="widget-holder col-md-12">
                <div class="widget-bg">
                    <div class="widget-body">

                        <div class="mail-inbox-header">
                            <div class="col-md-6">
                                <div class="mail-inbox-tools d-flex align-items-center">

                                    <div class="btn-group">
                                        <a href="{{ route('customers.view.import') }}" class="btn btn-sm btn-link fs-14 mr-2">
                                            <i class="list-icon fs-18 mr-r-5 fa fa-upload" style="margin-top: 5px;"></i> <strong>Importar</strong>
                                        </a>
                                        <div class="dropdown">
                                            <a href="javascript:void(0)" data-toggle="dropdown" class="btn btn-sm fs-14 fw-semibold btn-link dropdown-toggle headings-color">
                                                <i class="feather feather-more-vertical text-muted fs-18 mr-2"></i> Ações
                                            </a>
                                            <div role="menu" class="dropdown-menu">
                                                <a class="dropdown-item" href="javascript:void(0)">Enviar mensagem</a>
                                                <a class="dropdown-item" href="javascript:void(0)">Exportar para PDF</a>
                                                <a class="dropdown-item" href="javascript:void(0)">Exportar para CSV</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item text-red" rel="excluirClientes"  href="javascript:void(0)">Remover</a>
                                            </div>
                                        </div>
                                        <!-- /.dropdown -->
                                    </div>
                                    <!-- /.btn-group -->
                                </div>
                                <!-- /.mail-inbox-tools -->
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-8 d-inline-block text-right">
                                    <form action="{{ route('subscriptions.search.simples') }}" method="get">
                                        @csrf
                                        @method('GET')

                                        <div class="form-group" style="margin-bottom: 0px;">
                                            <div class="input-group input-group-sm">
                                                <input class="form-control fs-14 input_busca" id="l8" name="busca" placeholder="Digite o nome do cliente..." type="text">
                                                <span class="input-group-btn">
                                                <button type="submit" class="btn btn-primary fs-14">Buscar</button>
                                            </span>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-3 d-inline-block text-right">
                                    <a class="btn btn-link bt_searchAdvanced">
                                        <i class="mr-r-5 fa fa-caret-down"></i>
                                        Busca avançada
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="search-advanced arrow-up" style="display: none;">
                                <form action="{{ route('subscriptions.search.advanced') }}" method="get">
                                    {{ csrf_field() }}

                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="tipo">Plano</label>
                                                <select name="plan_id" id="plan_id" class="form-control selectpicker">
                                                    <option value="">Selecione</option>
                                                    @foreach($plans as $plan)
                                                        <option value="{{$plan->id}}">{{$plan->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="cycle_id">Ciclo</label>
                                                <select name="cycle_id" id="cycle_id" class="form-control selectpicker">
                                                    <option value="">Selecione</option>
                                                    @foreach($assinaturas as $assinatura)
                                                        <option value="{{$assinatura->plan->payment_cycle->id}}">{{$assinatura->plan->payment_cycle->name}}</option>
                                                    @endforeach
                                                </select>
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
                            <table class="table table-hover" id="tabela_assinaturas">
                                <thead>
                                <tr>
                                    <th class="txt-center" style="width: 15px;">
                                        <input type="checkbox" class="selecionaTodos">
                                    </th>
                                    <th>ID</th>
                                    <th>Cliente</th>
                                    <th>Plano</th>
                                    <th>Ativado em</th>
                                    <th>Status</th>
                                    <th>Valor</th>
                                    <th>Ciclo</th>
                                    <th class="text-right">Vencimento</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($assinaturas as $assinatura)
                                    <tr>
                                        <td>
                                            <input name="id" class="td_item" value="{{ $assinatura->id }}" type="checkbox">
                                        </td>
                                        <td>
                                            <a href="{{ route('subscriptions.view', $assinatura->id) }}">#{{ $assinatura->id }}</a>

                                        </td>
                                        <td>

                                            <a href="">{{ $assinatura->customer->name}}</a>
                                        </td>
                                        <td>
                                            <a href="#">{{ $assinatura->plan->name }}</a>
                                            {{ $assinatura->domain }}
                                        </td>
                                        <td>{{ $assinatura->activated_at->format('d/m/Y') }}</td>
                                        <td>
                                            @switch($assinatura->status)
                                                @case(0)
                                                <strong class="text-danger">
                                                    <i class="icone-attention-circled"></i>
                                                    Suspenso
                                                </strong>
                                                @break

                                                @case(1)
                                                <strong class="text-green">
                                                    <i class="icone-ok-3"></i>
                                                    Ativo
                                                </strong>
                                                @break

                                                @case(2)
                                                <strong class="text-dribbble">
                                                    <i class="icone-gift"></i>
                                                    Cortesia
                                                </strong>
                                                @break
                                            @endswitch

                                            @if($assinatura->cancelled == 1)
                                                <strong class="text-secondary">
                                                    <i class="icone-lock"></i>
                                                    Cancelando...
                                                </strong>
                                            @endif
                                        </td>
                                        <td>R$ {{ numFormat($assinatura->total) }}</td>
                                        <td>{{ $assinatura->plan->payment_cycle->name }}</td>
                                        <td class="text-right">
                                            {{ $assinatura->due->format('d/m/Y') }}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </form>

                        <div class="row">
                            <div class="col-7 mt-1">
                            <span class="headings-font-family">
                                Exibindo de {{ $assinaturas->firstItem() }} à {{ $assinaturas->lastItem() }} de <b>{{ $assinaturas->total() }}</b> registros
                            </span>
                            </div>

                            <div class="col-5">
                                <div class="btn-group float-right">
                                    {{ $assinaturas->links() }}
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
    <script type="text/javascript" src="{{ asset('js/widgets/clientes.js') }}"></script>
@endsection