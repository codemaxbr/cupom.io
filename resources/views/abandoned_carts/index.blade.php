@extends('layouts.sistema')

@section('content')

    <!-- Page Title Area -->
    <div class="row page-title clearfix">
        <div class="page-title-left">
            <h6 class="page-title-heading mr-0 mr-r-5">Carrinhos Abandonados</h6>
            <!--<p class="page-title-description mr-0 d-none d-md-inline-block">statistics, charts and events</p>-->
        </div>
        <!-- /.page-title-left -->
        <div class="page-title-right d-none d-sm-inline-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('customers.index') }}">Clientes</a></li>
                <li class="breadcrumb-item active">Carrinhos Abandonados</li>
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
            <div class="widget-holder col-md-12">
                <div class="widget-bg">
                    <div class="widget-body">

                        <div class="mail-inbox-header">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="mail-inbox-tools d-flex align-items-center">

                                        <div class="btn-group">
                                            <a href="{{ route('customers.view.import') }}" class="btn btn-sm btn-link mr-2 fs-14">
                                                <i class="list-icon fs-18 mr-r-5 fa fa-download" style="margin-top: 5px;"></i> <strong>Exportar</strong>
                                            </a>

                                            <div class="dropdown">
                                                <a href="javascript:void(0)" data-toggle="dropdown" class="btn btn-sm fs-14 fw-semibold btn-link dropdown-toggle headings-color">
                                                    <i class="feather feather-more-vertical text-muted fs-18 mr-2"></i> Ações
                                                </a>
                                                <div role="menu" class="dropdown-menu">
                                                    <a class="dropdown-item" href="javascript:void(0)">Enviar Lembrete</a>
                                                    <a class="dropdown-item" href="javascript:void(0)">Gerar cupom</a>
                                                    <a class="dropdown-item" href="javascript:void(0)">Converter em Pedido</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item text-red" href="javascript:void(0)">Remover</a>
                                                </div>
                                            </div>
                                            <!-- /.dropdown -->
                                        </div>
                                        <!-- /.btn-group -->
                                    </div>
                                </div>
                                <!-- /.mail-inbox-tools -->
                            </div>

                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-12 d-inline-block pull-right">
                                        <form action="{{ route('customers.search.simple') }}" method="get">
                                            {{ csrf_field() }}

                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-6 pull-right">
                                                    <div class="form-input-icon">
                                                        <i class="fa fa-calendar list-icon"></i>
                                                        <input class="form-control daterange" id="l6" placeholder="Período" type="text">
                                                    </div>
                                                </div>

                                                <div class="col-md-3 pull-right">
                                                    <select name="" id="" class="form-control selectpicker">
                                                        <option value="-">Todos</option>
                                                        <option value="0">Abandonado</option>
                                                        <option value="1">Recuperado</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-2 pull-right">
                                                    <button type="submit" class="btn btn-sm btn-block btn-primary fs-14">Buscar</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <form method="post" id="lista_cadastros">
                            {{ csrf_field() }}
                            <table class="table table-hover" id="tabela_carrinhos_abandonados">
                                <thead>
                                <tr>
                                    <th class="txt-center" style="width: 15px;">
                                        <input type="checkbox" class="selecionaTodos">
                                    </th>
                                    <th>ID</th>
                                    <th>Cliente</th>
                                    <th>Plano selecionado</th>
                                    <th>Subtotal</th>
                                    <th>Lembrete</th>
                                    <th>Status</th>
                                    <th class="text-right">Data do Carrinho</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($abandoned_carts as $cart)
                                    <tr>
                                        <td>
                                            <input name="id" class="td_item" value="{{ $cart->id }}" type="checkbox">
                                        </td>
                                        <td>
                                            <a href="{{ route('abandoned_carts.show', $cart->id) }}">#{{ $cart->id }}</a>
                                        </td>
                                        <td>
                                            @if($cart->customer)
                                                {{ $cart->customer->name }}
                                            @else
                                                Visitante
                                            @endif
                                        </td>
                                        <td><a href="#">{{ $cart->plan->name }}</a></td>
                                        <td>R$ {{ numFormat($cart->total) }}</td>
                                        <td>
                                            @if($cart->status_email)
                                                <strong class="text-green">Enviado</strong>
                                            @else
                                                <strong class="text-red">Não enviado</strong>
                                            @endif
                                        </td>
                                        <td>
                                            @if($cart->status)
                                                <span class="badge badge-success fs-13">Recuperado</span>
                                            @else
                                                <span class="badge badge-orange fs-13">Abandonado</span>
                                            @endif
                                        </td>
                                        <td class="text-right">
                                            {{ $cart->created_at->format('d/m/Y H:i') }}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </form>

                        <div class="row">
                            <div class="col-7 mt-1">
                            <span class="headings-font-family">
                                Exibindo de {{ $abandoned_carts->firstItem() }} à {{ $abandoned_carts->lastItem() }} de <b>{{ $abandoned_carts->total() }}</b> registros
                            </span>
                            </div>

                            <div class="col-5">
                                <div class="btn-group float-right">
                                    {{ $abandoned_carts->links() }}
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