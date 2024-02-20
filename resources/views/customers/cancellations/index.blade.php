@extends('layouts.sistema')

@section('content')

    <!-- Page Title Area -->
    <div class="row page-title clearfix">
        <div class="page-title-left">
            <h6 class="page-title-heading mr-0 mr-r-5">Cancelamentos</h6>
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
                <li class="breadcrumb-item active">Cancelamentos</li>
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
                                    <form action="{{ route('customers.search.simple') }}" method="get">
                                        {{ csrf_field() }}

                                        <div class="form-group" style="margin-bottom: 0px;">
                                            <div class="input-group input-group-sm">
                                                <input class="form-control fs-14 input_busca" id="l8" name="busca" placeholder="Buscar assinaturas..." type="text">
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
                                                <select name="tipo" id="tipo" class="form-control selectpicker">
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
                            <table class="table table-hover" id="tabela_assinaturas">
                                <thead>
                                <tr>
                                    <th class="txt-center" style="width: 15px;">
                                        <input type="checkbox" class="selecionaTodos">
                                    </th>
                                    <th>ID</th>
                                    <th>Cliente</th>
                                    <th>Plano</th>
                                    <th>Cancelado em</th>
                                    <th>Responsável</th>
                                    <th>Total</th>
                                    <th class="text-right">Ciclo</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($cancellations as $assinatura)
                                    <tr>
                                        <td>
                                            <input name="id" class="td_item" value="{{ $assinatura->id }}" type="checkbox">
                                        </td>
                                        <td>
                                            <a href="{{ route('subscriptions.view', $assinatura->id) }}">#{{ $assinatura->id }}</a>
                                        </td>
                                        <td>
                                            {{ $assinatura->customer->name}}
                                        </td>
                                        <td>
                                            <a href="#">{{ $assinatura->plan->name }}</a>
                                            {{ $assinatura->domain }}
                                        </td>
                                        <td>{{ $assinatura->cancelled_at->format('d/m/Y H:i') }}</td>
                                        <td>{{ $assinatura->user->name }}</td>
                                        <td>R$ {{ numFormat($assinatura->total) }}</td>
                                        <td class="text-right">{{ $assinatura->plan->payment_cycle->name }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center">Ainda não existe cancelamentos</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </form>

                        <div class="row">
                            <div class="col-7 mt-1">
                            <span class="headings-font-family">
                                Exibindo de {{ $cancellations->firstItem() }} à {{ $cancellations->lastItem() }} de <b>{{ $cancellations->total() }}</b> registros
                            </span>
                            </div>

                            <div class="col-5">
                                <div class="btn-group float-right">
                                    {{ $cancellations->links() }}
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