@extends('layouts.sistema')
@section('content')

    <!-- Page Title Area -->
    <div class="row page-title clearfix">
        <div class="page-title-left">
            <h6 class="page-title-heading mr-0 mr-r-5">Novo item opcional</h6>
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
                    <a href="index.html">Opcionais</a>
                </li>
                <li class="breadcrumb-item active">Novo</li>
            </ol>
        </div>
    </div>

    @if (session('error'))
        <div class="alert alert-danger">
            <i class="icone-attention"></i>
            {{ session('error') }}
        </div>
    @endif

    <!-- =================================== -->
    <!-- Different data widgets ============ -->
    <!-- =================================== -->
    <form class="widget-list" id="config-plans-add" method="post" action="{{ route('config.optionals.store') }}">

        @csrf

        <div class="row">

            <!-- Tabs Content -->
            <div class="content-with-sidebar">

                <!-- Formulário -->
                <div class="formulario mr-t-10 bg-white p-3 border-radius-3">
                    <h6 class="mr-b-20 mr-t-0">
                        <i class="icone-info-circled-1"></i>
                        Detalhes do Item
                    </h6>

                    <div class="row">
                        <div class="col-md-3 noPadding text-right">
                            <label for="nome">Nome do Opcional <b class="text-red">*</b></label>
                        </div>
                        <div class="col-md-5 form-group">
                            <input class="form-control" type="text" id="nome" name="name" value="{{ old('name') }}" required aria-required="true">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 noPadding text-right">
                            <label for="descricao">Descrição</label>
                        </div>
                        <div class="col-md-7 form-group">
                            <textarea name="description" id="descricao" class="form-control" style="height: 150px; resize: none;">{{ old('description') }}</textarea>
                        </div>
                    </div>

                    <!-- Email de Boas-vindas -->
                    <div class="row">
                        <div class="col-md-3 noPadding text-right">
                            <label for="email_template">E-mail de boas-vindas</label>
                        </div>

                        <div class="col-md-5">
                            <select name="email_template" id="email_template" class="form-control selectpicker">
                                <option value="">Nenhum</option>
                            </select>
                        </div>
                    </div>

                </div>
                <!-- / Formulário -->

                <!-- Form Preço -->
                <div class="formulario mr-t-20 bg-white p-3 border-radius-3">
                    <h6 class="mr-b-20 mr-t-0">
                        <i class="icone-dollar"></i>
                        Preço
                    </h6>

                    <!-- Preço -->
                    <div class="row">
                        <div class="col-md-3 noPadding text-right">
                            <label for="preco">Preço <b class="text-red">*</b></label>
                        </div>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="input-group form-group">
                                        <div class="input-group-addon">R$</div>
                                        <input type="text" class="form-control ls-price" id="preco" name="price" required value="{{ old('price') }}" placeholder="0,00">
                                    </div>

                                    <label class="error" for="preco" style="display:none; margin-top: -10px; margin-bottom: 10px;"></label>
                                </div>

                                <div class="col-md-7 noPadding-left form-group">
                                    @forelse($termos as $termo)
                                        <div class="radiobox d-inline">
                                            <label>
                                                <input type="radio" name="type_term_id" class="terms" value="{{ $termo->id }}" @if($termo->id == 1 || old('term_id') == $termo->id) checked="checked" @endif>
                                                <span class="label-text">{{ $termo->name }}</span>
                                            </label>
                                        </div>
                                    @empty
                                        <div class="d-inline">
                                            Nenhum termo encontrado
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Faturar a cada -->
                    <div class="row input-ciclo">
                        <div class="col-md-3 noPadding text-right">
                            <label for="repetir">Ciclo de pagamento</label>
                        </div>

                        <div class="col-md-8">
                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select name="payment_cycle_id" id="repetir" class="form-control selectpicker">
                                            @foreach($ciclos as $ciclo)
                                                <option value="{{ $ciclo->id }}">{{ $ciclo->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Domínio -->
                    <div class="row mr-b-5">
                        <div class="col-md-3 noPadding text-right"></div>

                        <div class="col-md-9">
                            <div class="checkbox checkbox-primary d-inline">
                                <label class="checkbox-checked">
                                    <input type="checkbox" name="suspend_principal" value="1" id="suspend_principal">
                                    <span class="label-text">
                                        Suspender opcional quando o plano principal estiver atrasado
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="formulario mr-t-20 bg-white p-3 border-radius-3">
                    <h6 class="mr-b-20 mr-t-0">
                        <i class="icone-flow-branch"></i>
                        Quais planos deseja incluir este opcional?
                    </h6>

                    @forelse($planos as $plano)
                        <div class="row">
                            <div class="col-md-3 noPadding text-right"></div>
                            <div class="col-md-9">
                                <div class="checkbox checkbox-primary d-inline">
                                    <label class="checkbox-checked">
                                        <input type="checkbox" name="plans[]" value="{{ $plano->id }}" id="suspend_principal">
                                        <span class="label-text text-primary">
                                            {{ $plano->name }}
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="row">
                            <div class="col-md-12 text-center">Você não possui planos cadastrados.</div>
                        </div>
                    @endforelse

                </div>

            </div>
            <!-- /.col-sm-8 -->

            <!-- User Actions -->
            <div class="actions-sidebar">

                <!-- Endereços -->
                <div class="widget-bg widget-notes mr-t-20 border-radius-3">
                    <div class="widget-body profile-user-description p-3">

                        <div class="row">
                            <div class="col-md-12">
                                <label for="visivel">
                                    Visibilidade
                                </label>
                                <div class="form-group mr-b-10">
                                    <select name="visibility" id="visivel" class="form-control selectpicker">
                                        <option value="1" @if(old('visibility') == 1) selected @endif>Público</option>
                                        <option value="2" @if(old('visibility') == 2) selected @endif>Apenas para assinantes</option>
                                        <option value="3" @if(old('visibility') == 3) selected @endif>Apenas para novas assinaturas</option>
                                        <option value="0" @if(old('visibility') == 0) selected @endif>Desativado</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-block btn-primary mr-b-10">
                            Salvar opcional
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

    <script type="text/javascript" src="{{ asset('js/functions/planos.js') }}"></script>
    <!-- jQuery Validation -->
    <script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-validation/localization/messages_pt_BR.min.js') }}"></script>

    <!-- Incluindo o JavaScript -->

    <script type="text/javascript">
        $(function (){
            $('#config-plans-add').validate();

            $('#servidor').selectpicker({
                noneSelectedText: 'Vazio'
            });

            $('.select-module').on('change', function () {
                var module = $(this).val();

                $.ajax({
                    method: "GET",
                    url: "{{ route('config.plans.module', '_module_') }}".replace('_module_', module),
                    dataType: 'html',

                    beforeSend: function () {
                        $('.load-module').html('<option>Carregando...</option>');
                    },

                    success: function (response) {
                        $('.load-module').html(response);
                    }
                });

                $.ajax({
                    method: "GET",
                    url: "{{ route('config.plans.comboserver', '_module_') }}".replace('_module_', module),
                    dataType: 'json',

                    beforeSend: function () {
                        $('#servidor').html('<option>Carregando...</option>');
                        $('#servidor').selectpicker('refresh');
                    },

                    success: function (servers) {

                        var html = '';
                        if(servers.length > 1){
                            html += '<option value="">Selecione</option>';
                        }
                        html += $.map(servers, function (server) {
                            return '<option value="'+server.id+'" data-html="'+server.name+'" data-subtext="'+server.ip+'">'+server.name+'</option>'
                        }).join('');

                        $('#servidor').html(html);
                        $('#servidor').selectpicker('refresh');
                    }
                });
            });
        });
    </script>
@endsection