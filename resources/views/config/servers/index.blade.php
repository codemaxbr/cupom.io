@extends('layouts.sistema')

@section('content')

    <!-- Page Title Area -->
    <div class="row page-title clearfix">
        <div class="page-title-left">
            <h6 class="page-title-heading mr-0 mr-r-5">Servidores</h6>
            <!--<p class="page-title-description mr-0 d-none d-md-inline-block">statistics, charts and events</p>-->
        </div>
        <!-- /.page-title-left -->
        <div class="page-title-right d-none d-sm-inline-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="{{ route('config.index') }}">Configurações</a>
                </li>
                <li class="breadcrumb-item active">Servidores</li>
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
                            <div class="col-md-9">
                                <div class="mail-inbox-tools d-flex align-items-center">

                                    <div class="d-none d-sm-block text-right mr-r-20">
                                        <a href="{{ route('config.servers.add') }}" class="btn btn-primary btn-sm fs-14">Vincular servidor</a>
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
                            <div class="col-md-3">
                                <div class="col-md-12 d-inline-block text-right">
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
                            </div>
                        </div>

                        <form method="post" id="lista_cadastros">
                            {{ csrf_field() }}
                            <table class="table table-hover" id="tabela_clientes">
                                <thead>
                                    <tr>
                                        <th>Servidor</th>
                                        <th>Monitor ID</th>
                                        <th>IP / Hostname</th>
                                        <th>Uptime</th>
                                        <th>Contas</th>
                                        <th class="text-right"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                @forelse($servers as $server)
                                    <tr>
                                        <td>
                                            <div class="user-block">
                                                <img class="" src="{{ asset('images/modules/panel/'.$server->module->slug.'_mini.png') }}" alt="user image">
                                                <span class="username">
                                                     <a rel="verServidor" data-id="22">{{ $server->name }}</a>
                                                </span>
                                                <span class="description">
                                                    {{ $server->datacenter }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="vertical-middle">{{ $server->monitor }}</td>
                                        <td class="vertical-middle">{{ $server->ip }}</td>
                                        <td class="vertical-middle">
                                            217 dias
                                            <span class="text-green fw-600">
                                                (99.4%)
                                            </span>
                                        </td>

                                        <td class="vertical-middle">
                                            <span class="badge badge-light">
                                                2 / {{ $server->limit_accounts }}
                                            </span>
                                        </td>

                                        <td class="text-right vertical-middle">
                                            <a href="#" class="link-btn mr-r-10">
                                                <i class="fa fa-trash fs-15"></i>
                                                Remover
                                            </a>

                                            <a href="#" class="link-btn">
                                                <i class="fa fa-pencil fs-15"></i>
                                                Editar
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Você ainda não tem servidores vinculados.</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </form>

                        <div class="row">
                            <div class="col-7 mt-1">
                            <span class="headings-font-family">
                                Exibindo de {{ $servers->firstItem() }} à {{ $servers->lastItem() }} de <b>{{ $servers->total() }}</b> registros
                            </span>
                            </div>

                            <div class="col-5">
                                <div class="btn-group float-right">
                                    {{ $servers->links() }}
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

    <div class="modal modal-info fade modal-add-server" tabindex="-1" role="dialog" aria-labelledby="modalServer" aria-hidden="true" style="display: none">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('config.servers.add') }}" id="config-servers-add" method="post">
                    @csrf
                    
                    <div class="modal-header text-inverse">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h5 class="modal-title" id="modalServer">Vincular servidor</h5>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body formulario">
                        <h6 class="mr-b-20 mr-t-0">
                            <i class="icone-info-circled-1"></i>
                            Geral
                        </h6>

                        <div class="row">
                            <div class="col-md-3 noPadding text-right">
                                <label for="nome">Descrição <b class="text-red">*</b></label>
                            </div>
                            <div class="col-md-5 form-group mr-b-10">
                                <input class="form-control" type="text" id="nome" name="name" value="{{ old('name') }}" minlength="2" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3 noPadding text-right">
                                <label for="ip">IP / Hostname <b class="text-red">*</b></label>
                            </div>
                            <div class="col-md-7 form-group mr-b-10">
                                <input class="form-control" type="text" id="ip" name="ip" value="{{ old('ip') }}" minlength="2" required>
                                <span class="loading d-none">
                                    <img src="{{ asset('images/ajax-loader2.gif') }}" alt="">
                                    Conectando...
                                </span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3 noPadding text-right">
                                <label for="os">OS <b class="text-red">*</b></label>
                            </div>
                            <div class="col-md-4 form-group mr-b-10">
                                <select class="selectpicker form-control" id="os" name="os" required aria-required="true">
                                    <option value="">Selecione</option>
                                    <optgroup label="Linux">
                                        <option data-content="<img src='{{ asset('images/modules/os/amazon.png') }}' /> Amazon AWS" value="amazon"></option>
                                        <option data-content="<img src='{{ asset('images/modules/os/debian.png') }}' /> Debian" value="debian"></option>
                                        <option data-content="<img src='{{ asset('images/modules/os/centos.png') }}' /> CentOS" value="centos"></option>
                                        <option data-content="<img src='{{ asset('images/modules/os/ubuntu.png') }}' /> Ubuntu" value="ubuntu"></option>
                                        <option data-content="<img src='{{ asset('images/modules/os/opensuse.png') }}' /> OpenSuse" value="opensuse"></option>
                                        <option data-content="<img src='{{ asset('images/modules/os/redhat.png') }}' /> Redhat" value="redhat"></option>
                                    </optgroup>
                                    <optgroup label="Windows">
                                        <option data-content="<img src='{{ asset('images/modules/os/windows.png') }}' /> Windows Server" value="windows"></option>
                                    </optgroup>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3 noPadding text-right">
                                <label for="datacenter">Datacenter</label>
                            </div>
                            <div class="col-md-5 form-group mr-b-10">
                                <input class="form-control" type="text" id="datacenter" name="datacenter" value="{{ old('datacenter') }}" aria-required="true">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3 noPadding text-right">
                                <label for="limite">Limite de Contas</label>
                            </div>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="number" id="limite" name="limit_accounts" value="{{ old('limit_accounts') }}" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h6 class="mr-b-20">
                            <i class="icone-flow-branch"></i>
                            Registros DNS
                        </h6>

                        <!-- Entradas DNS -->
                        <div class="row">
                            <div class="col-md-3 noPadding text-right">
                                <label id="ns1">DNS Primário</label>
                            </div>

                            <div class="col-md-9">
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group mr-b-10">
                                            <input type="text" class="form-control" name="ns1" id="ns1" value="{{ old('ns1') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-5">
                                        <div class="form-group mr-b-10">
                                            <div class="input-group">
                                                <div class="input-group-addon">IP</div>
                                                <input type="text" class="form-control" id="ns1_ip" name="ns1_ip" value="{{ old('ns1_ip') }}" aria-required="true">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- Entradas DNS -->
                        <div class="row">
                            <div class="col-md-3 noPadding text-right">
                                <label id="ns2">DNS Secundário</label>
                            </div>

                            <div class="col-md-9">
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group mr-b-10">
                                            <input type="text" class="form-control" name="ns2" id="ns2" value="{{ old('ns2') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-5">
                                        <div class="form-group mr-b-10">
                                            <div class="input-group">
                                                <div class="input-group-addon">IP</div>
                                                <input type="text" class="form-control" id="ns2_ip" name="ns2_ip" value="{{ old('ns2_ip') }}" aria-required="true">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- Entradas DNS -->
                        <div class="row">
                            <div class="col-md-3 noPadding text-right">
                                <label id="ns3">DNS Adicional</label>
                            </div>

                            <div class="col-md-9">
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="ns3" id="ns3" value="{{ old('ns3') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon">IP</div>
                                                <input type="text" class="form-control" id="ns3_ip" name="ns3_ip" value="{{ old('ns3_ip') }}" aria-required="true">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Fim Modal Body -->

                    <div class="modal-footer">
                        <button type="submit" rel="submitAdd_server" class="btn btn-primary btn-sm fs-14 ripple text-left">
                            <i class="icone-floppy mr-r-5"></i>
                            Salvar e monitorar
                        </button>
                        <button type="button" class="btn btn-default btn-sm fs-14 ripple text-left" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

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

    <!-- jQuery Validation -->
    <script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-validation/localization/messages_pt_BR.min.js') }}"></script>

    <!-- Incluindo o JavaScript -->

    <script type="text/javascript">
        $(function (){
            $('#config-servers-add').validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 2
                    },
                    ip: {
                        required: true,
                        minlength: 2,
                        remote: {
                            type: "POST",
                            url: "{{ route('config.servers.test') }}",
                            data: {
                                hostname: function () {
                                    return $('#ip').val();
                                },
                                _token: function () {
                                    return $('[name="_token"]').val();
                                }
                            },
                            beforeSend: function (e) {
                                console.log("Carregando...");
                                $('.loading').addClass('d-block');
                            },

                            complete: function (response) {
                                $('.loading').removeClass('d-block');
                                return true;
                            }
                        }
                    },
                    os: "required"
                },

                messages: {
                    ip: {
                        remote: "IP/Hostname informado sem resposta ou inválido"
                    }
                }
            });
        });
    </script>
@endsection