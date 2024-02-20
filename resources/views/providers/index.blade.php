@extends('layouts.sistema')

@section('content')

    <!-- Page Title Area -->
    <div class="row page-title clearfix">
        <div class="page-title-left">
            <h6 class="page-title-heading mr-0 mr-r-5">Fornecedores</h6>
            <!--<p class="page-title-description mr-0 d-none d-md-inline-block">statistics, charts and events</p>-->
        </div>
        <!-- /.page-title-left -->
        <div class="page-title-right d-none d-sm-inline-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Fornecedores</li>
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
            O(A) fornecedor <b>{{ session('deleted') }}</b> foi excluído(a).
        </div>
    @endif

    <div class="alert alert-success" id="deleteJSON" style="display: none;">
        <i class="icone-ok-3"></i>
        Os <b class="qtd_select"></b> fornecedores selecionados foram excluídos.
    </div>

    <div class="widget-list">
        <div class="row">
            <div class="widget-holder col-md-12">
                <div class="widget-bg mr-b-20">
                    <div class="widget-body p-2">

                        <!-- Barra de Ações -->
                        <div class="mail-inbox-header">
                            <div class="col-md-6">
                                <div class="mail-inbox-tools d-flex align-items-center">

                                    <div class="d-none d-sm-block text-right mr-r-20">
                                        <a href="{{ route('providers.create') }}" class="btn btn-primary btn-sm fs-14">
                                            <i class="icone-plus-circled"></i>
                                            Novo fornecedor
                                        </a>
                                    </div>

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

                            <div class="col-md-3 text-right">

                                <div class="radiobox d-inline mr-r-10">
                                    <label>
                                        <input type="radio" name="radio1Option[]" value="1"> <span class="label-text">Somente os ativos</span>
                                    </label>
                                </div>

                                <div class="radiobox d-inline mr-r-10">
                                    <label>
                                        <input type="radio" name="radio1Option[]" value="0" checked="checked"> <span class="label-text">Todos</span>
                                    </label>
                                </div>


                            </div>

                            <div class="col-md-3">
                                <form action="{{ route('customers.search.simple') }}" method="get">
                                    {{ csrf_field() }}

                                    <div class="form-group" style="margin-bottom: 0px;">
                                        <div class="input-group input-group-sm">
                                            <input class="form-control fs-14 input_busca" id="l8" name="busca" placeholder="Buscar por nome" type="text">
                                            <span class="input-group-btn">
                                                <button type="submit" class="btn btn-primary fs-14">
                                                    <i class="icone-search mr-l-5"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Fim da Barra de Ações -->

                    </div>
                    <!-- /.widget-body -->
                </div>

                <table class="table table-hover" id="tabela_clientes">
                    <tbody>
                        @foreach($providers as $provider)
                        <tr class="table-div">
                            <td>
                                <a href="#">{{ $provider->name }} @if($provider->fantasia != null)({{ $provider->fantasia }})@endif</a>
                                <span class="text-dark-light">{{ $provider->cpf_cnpj }}</span>
                            </td>
                            <td>
                                @if($provider->email != null)
                                <span class="d-block">{{ $provider->email }}</span>
                                @endif

                                @if($provider->phone != null)
                                <span class="d-block">{{ $provider->phone }}</span>
                                @endif
                            </td>
                            <td>
                                @if($provider->servers_count > 0)
                                    <strong class="text-green">
                                        <i class="icone-ok-3"></i>
                                        Ativo
                                    </strong>
                                @endif

                                @if($provider->debits_count > 0)
                                    <strong class="text-danger">
                                        <i class="icone-attention-circled"></i>
                                        Débitos pendentes
                                    </strong>
                                @endif

                                @if($provider->debits_count == 0 && $provider->servers_count == 0)
                                <strong class="text-muted">
                                    <i class="icone-clock"></i>
                                    Ocioso
                                </strong>
                                @endif
                            </td>

                            <td class="text-right">
                                <a href="#" class="table-actions">
                                    <i class="icone-pencil"></i>
                                </a>

                                <a href="#" class="table-actions">
                                    <i class="icone-trash"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                @if($providers->isEmpty())
                    Você não tem fornecedores
                @else
                    <div class="row">
                        <div class="col-7 mt-1">
                                <span class="headings-font-family">
                                    Exibindo de {{ $providers->firstItem() }} à {{ $providers->lastItem() }} de <b>{{ $providers->total() }}</b> registros
                                </span>
                        </div>

                        <div class="col-5">
                            <div class="btn-group float-right">
                                {{ $providers->links() }}
                            </div>
                        </div>
                    </div>
                @endif

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