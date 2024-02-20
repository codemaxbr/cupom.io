@extends('layouts.sistema')
@section('content')

    <!-- Page Title Area -->
    <div class="row page-title clearfix">
        <div class="page-title-left">
            <h6 class="page-title-heading mr-0 mr-r-5">Novo servidor</h6>
        </div>

        <!-- Breadcrumb -->
        <div class="page-title-right d-none d-sm-inline-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.html">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="index.html">Configurações</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="index.html">Servidores</a>
                </li>
                <li class="breadcrumb-item active">Novo</li>
            </ol>
        </div>
    </div>

    <!-- =================================== -->
    <!-- Different data widgets ============ -->
    <!-- =================================== -->
    <form class="widget-list" method="post" action="{{ route('config.servers.store') }}">

        @csrf

        <div class="row">

            <!-- Tabs Content -->
            <div class="content-with-sidebar">

                <!-- Formulário -->
                <div class="formulario mr-t-20 bg-white p-3 border-radius-3">
                    <h6 class="mr-b-20 mr-t-0">
                        <i class="icone-info-circled-1"></i>
                        Geral
                    </h6>

                    <div class="row">
                        <div class="col-md-3 noPadding text-right">
                            <label for="name">Nome <b class="text-red">*</b></label>
                        </div>
                        <div class="col-md-5 form-group mr-b-10">
                            <input class="form-control" type="text" id="name" name="name" value="{{ old('name') }}" required aria-required="true">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 noPadding text-right">
                            <label for="ip">IP / Hostname <b class="text-red">*</b></label>
                        </div>
                        <div class="col-md-5 form-group mr-b-10">
                            <input class="form-control" type="text" id="ip" name="ip" value="{{ old('ip') }}" required aria-required="true">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 noPadding text-right">
                            <label for="datacenter">Datacenter</label>
                        </div>
                        <div class="col-md-4 form-group mr-b-10">
                            <input class="form-control" type="text" id="datacenter" name="datacenter" value="{{ old('datacenter') }}" required aria-required="true">
                        </div>
                    </div>

                    <!-- Preço -->
                    <div class="row">
                        <div class="col-md-3 noPadding text-right">
                            <label for="cost">Custo Mensal</label>
                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="input-group form-group">
                                        <div class="input-group-addon">R$</div>
                                        <input type="text" class="form-control" id="cost" name="cost" required value="{{ old('cost') }}" aria-required="true">
                                    </div>

                                    <label class="error" for="preco" style="display:none;"></label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 noPadding text-right">
                            <label for="limit_accounts">Limite de contas <b class="text-red">*</b></label>
                        </div>
                        <div class="col-md-2 form-group mr-b-10">
                            <input class="form-control" type="number" id="limit_accounts" name="limit_accounts" value="{{ old('limit_accounts') }}" required aria-required="true">
                        </div>
                    </div>

                </div>
                <!-- / Formulário -->

                <!-- Form Preço -->
                <div class="formulario mr-t-20 bg-white p-3 border-radius-3">
                    <h6 class="mr-b-20 mr-t-0">
                        <i class="icone-flow-branch"></i>
                        Registros DNS
                    </h6>

                    <!-- Entradas DNS -->
                    <div class="row">
                        <div class="col-md-3 noPadding text-right">
                            <label id="total_parcelado">Primeiro DNS</label>
                        </div>

                        <div class="col-md-9">
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group mr-b-10">
                                        <input type="text" class="form-control" name="ns1" value="{{ old('ns1') }}" id="">
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
                            <label id="total_parcelado">Segundo DNS</label>
                        </div>

                        <div class="col-md-9">
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group mr-b-10">
                                        <input type="text" class="form-control" name="ns2" value="{{ old('ns2') }}">
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
                            <label id="total_parcelado">Terceiro DNS</label>
                        </div>

                        <div class="col-md-9">
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="ns3" value="{{ old('ns3') }}">
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

                    <!-- Entradas DNS -->
                    <div class="row">
                        <div class="col-md-3 noPadding text-right">
                            <label id="total_parcelado">Quarto DNS</label>
                        </div>

                        <div class="col-md-9">
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="ns4" value="{{ old('ns4') }}">
                                    </div>
                                </div>

                                <div class="col-md-5">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon">IP</div>
                                            <input type="text" class="form-control" id="ns4_ip" name="ns4" value="{{ old('ns4_ip') }}" aria-required="true">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>

                <!-- Formulário -->
                <div class="formulario mr-t-20 bg-white p-3 border-radius-3">
                    <h6 class="mr-b-20 mr-t-0">
                        <i class="icone-share"></i>
                        Módulo de Integração
                    </h6>

                    <div class="row">
                        <div class="col-md-3 noPadding text-right">
                            <label for="module">Módulo <b class="text-red">*</b></label>
                        </div>
                        <div class="col-md-4 form-group mr-b-10">
                            <select class="selectpicker form-control select-module" id="os" name="module" required="" aria-required="true">
                                <option value="">Selecione</option>
                                @foreach($modules as $module)
                                <optgroup label="{{ $module->name }}">
                                    @foreach($module->modules as $modulo)
                                    <option data-content="<img src='{{ asset('images/modules/'.$module->slug.'/'.$modulo->slug.'_mini.png') }}' /> {{ $modulo->name }}" value="{{ $modulo->id }}"></option>
                                    @endforeach
                                </optgroup>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="loadModule"></div>

                </div>

            </div>
            <!-- /.col-sm-8 -->

            <!-- User Actions -->
            <div class="actions-sidebar">

                <!-- Endereços -->
                <div class="widget-bg widget-notes mr-t-20 border-radius-3">
                    <div class="widget-body profile-user-description p-3">
                        <h6 class="mr-t-0">
                            Salvar alterações
                        </h6>

                        <button type="submit" class="btn btn-block btn-primary mr-b-10">
                            Salvar servidor
                        </button>

                        <div class="contact-details-cell text-left">
                            <p class="mr-b-0 w-100">
                                <small class="heading-font-family fw-500">Última atualização</small><br />
                                16/07/2018 às 12:52h
                            </p>
                        </div>
                    </div>
                </div>
                <!-- ./ Endereços -->

            </div>

        </div>
    </form>

    <script type="text/javascript">
        $(function () {
            $('.select-module').on('change', function () {
                var module = $(this).val();

                $.ajax({
                    method: "GET",
                    url: "{{ route('config.servers.module', '_module_') }}".replace('_module_', module),
                    dataType: 'html',

                    beforeSend: function () {
                        $('.loadModule').html('<option>Carregando...</option>');
                    },

                    success: function (response) {
                        $('.loadModule').html(response);
                    }
                });
            });
        })
    </script>
@endsection