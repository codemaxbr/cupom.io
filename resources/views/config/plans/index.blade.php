@extends('layouts.sistema')

@section('content')

    <!-- Page Title Area -->
    <div class="row page-title clearfix">
        <div class="page-title-left">
            <h6 class="page-title-heading mr-0 mr-r-5">Planos de Assinatura</h6>
            <!--<p class="page-title-description mr-0 d-none d-md-inline-block">statistics, charts and events</p>-->
        </div>
        <!-- /.page-title-left -->
        <div class="page-title-right d-none d-sm-inline-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="{{ route('config.plans.index') }}">Financeiro</a>
                </li>
                <li class="breadcrumb-item active">Planos de Assinatura</li>
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
            O plano <b>{{ session('deleted') }}</b> foi removido.
        </div>
    @endif

    <div class="alert alert-success" id="deleteJSON" style="display: none;">
        <i class="icone-ok-3"></i>
        Os <b class="qtd_select"></b> planos selecionados foram removidos.
    </div>

    <div class="widget-list">
        <div class="row">
            <div class="widget-holder col-md-12">
                <div class="widget-bg">
                    <div class="widget-body">

                        <div class="mail-inbox-header">
                            <div class="col-md-6">
                                <div class="mail-inbox-tools d-flex align-items-center">

                                    <div class="d-none d-sm-block text-right mr-r-20">
                                        <a href="{{ route('config.plans.add') }}" class="btn btn-primary btn-sm fs-14">Adicionar plano</a>
                                    </div>

                                    <div class="btn-group">
                                        <a href="{{ route('customers.view.import') }}" class="btn btn-sm btn-link mr-2 text-muted">
                                            <i class="list-icon fs-18 fa fa-download" style="margin-top: 5px;"></i>
                                        </a>
                                        <a href="javascript:void(0)" rel="removerPlanos" class="btn btn-sm btn-link mr-2 text-muted">
                                            <i class="list-icon fs-18 feather feather-trash-2"></i>
                                        </a>
                                        <div class="dropdown">
                                            <a href="javascript:void(0)" data-toggle="dropdown" class="btn btn-sm fs-14 fw-semibold btn-link dropdown-toggle headings-color">
                                                <i class="feather feather-more-vertical text-muted fs-18 mr-2"></i> Ações
                                            </a>
                                            <div role="menu" class="dropdown-menu">
                                                <a class="dropdown-item" href="javascript:void(0)">First Task</a>
                                                <a class="dropdown-item" href="javascript:void(0)">Second Task</a>
                                                <a class="dropdown-item" href="javascript:void(0)">Tird Task</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="javascript:void(0)">Grand Task</a>
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
                                    <form action="{{ route('customers.search.simple') }}" method="get">
                                        {{ csrf_field() }}

                                        <div class="form-group" style="margin-bottom: 0px;">
                                            <div class="input-group input-group-sm">
                                                <input class="form-control fs-14 input_busca" id="l8" name="busca" placeholder="Buscar..." type="text">
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
                                <form action="{{ route('customers.search.advanced') }}" method="get">
                                    {{ csrf_field() }}

                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="tipo">Tipo</label>
                                                <select name="tipo" id="tipo" class="form-control">
                                                    <option value="fisica">Pessoa Física</option>
                                                    <option value="juridica">Pessoa Jurídica</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="email">E-mail</label>
                                                <input type="text" id="email" name="email" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="col-md-3 div_cpf">
                                            <div class="form-group">
                                                <label for="cpf">CPF</label>
                                                <input type="text" id="cpf" name="cpf" class="form-control formatCPF" />
                                            </div>
                                        </div>
                                        <div class="col-md-3 div_cnpj" style="display: none;">
                                            <div class="form-group">
                                                <label for="cnpj">CNPJ</label>
                                                <input type="text" name="cnpj" id="cnpj" class="form-control formatCNPJ" />
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="telefone">Telefone</label>
                                                <input type="text" id="telefone" name="telefone" class="form-control formatTEL" />
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <button type="submit" class="btn btn-primary btn-search-advanced">
                                                <i class="list-icon feather feather-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad animi at commodi, delectus dolore.</p>
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
                                    <th>ID</th>
                                    <th>Status</th>
                                    <th>Descrição</th>
                                    <th>Preço</th>
                                    <th>Tipo de Contrato</th>
                                    <th>Assinantes</th>

                                    <th class="text-right"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($planos as $plano)
                                    <tr>
                                        <td>
                                            <input name="uuid" class="td_item" value="0" nome="" type="checkbox">
                                        </td>
                                        <td>{{ $plano->id }}</td>
                                        <td>
                                            <strong class="text-green">Ativo</strong>
                                        </td>
                                        <td>
                                            <a href="{{route('config.plans.edit', $plano->id)}}">{{ $plano->name }}</a>
                                        </td>
                                        <td>R$ {{ numFormat($plano->price) }}</td>
                                        <td>{{ $plano->payment_cycle->name }}</td>
                                        <td><strong class="text-dark">{{ $plano->subscriptions_count }}</strong></td>

                                        <td class="text-right">
                                            <a href="#" class="link-btn mr-r-10">
                                                <i class="fa fa-shopping-cart fs-15"></i>
                                            </a>

                                            <a href="{{route('config.plans.edit', $plano->id)}}" class="link-btn">
                                                <i class="fa fa-pencil fs-15"></i>
                                            </a>
                                        </td>
                                    </tr>

                                 @endforeach
                                </tbody>
                            </table>
                        </form>

                        <div class="row">
                            <div class="col-7 mt-1">
                            <span class="headings-font-family">
                                Exibindo de {{ $planos->firstItem() }} à {{ $planos->lastItem() }} de <b>{{ $planos->total() }}</b> registros
                            </span>
                            </div>

                            <div class="col-5">
                                <div class="btn-group float-right">
                                    {{ $planos->links() }}
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