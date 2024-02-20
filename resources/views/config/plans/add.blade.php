@extends('layouts.sistema')
@section('content')

    <!-- Page Title Area -->
    <div class="row page-title clearfix">
        <div class="page-title-left">
            <h6 class="page-title-heading mr-0 mr-r-5">Novo plano de assinatura</h6>
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
                    <a href="index.html">Planos</a>
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
    <form class="widget-list" id="config-plans-add" method="post" action="{{ route('config.plans.add.submit') }}">

        @csrf

        <div class="row">

            <!-- Tabs Content -->
            <div class="content-with-sidebar">

                <!-- Formulário -->
                <div class="formulario mr-t-20 bg-white p-3 border-radius-3">
                    <h6 class="mr-b-20 mr-t-0">
                        <i class="icone-info-circled-1"></i>
                        Detalhes do Plano
                    </h6>

                    <div class="row">
                        <div class="col-md-3 noPadding text-right">
                            <label for="nome">Nome do plano <b class="text-red">*</b></label>
                        </div>
                        <div class="col-md-5 form-group">
                            <input class="form-control" type="text" id="nome" name="name" value="{{ old('name') }}" required aria-required="true">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 noPadding text-right">
                            <label for="tipo">Tipo <b class="text-red">*</b></label>
                        </div>
                        <div class="col-md-3 form-group">
                            <select name="type_plan_id" id="tipo" class="form-control selectpicker">
                                @forelse($tipos as $tipo)
                                    <option value="{{ $tipo->id }}" @if(old('type') == $tipo->id) selected @endif>{{ $tipo->name }}</option>
                                @empty
                                    <option value="">Nenhum encontrado</option>
                                @endforelse
                            </select>
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

                    <!-- Domínio -->
                    <div class="row mr-t-5">
                        <div class="col-md-3 noPadding text-right"></div>

                        <div class="col-md-9">
                            <div class="checkbox checkbox-primary d-inline">
                                <label class="checkbox-checked">
                                    <input type="checkbox" name="domain" id="dominio">
                                    <span class="label-text">
                                        Este plano necessita de um domínio
                                    </span>
                                </label>
                            </div>
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

                    <!-- Parcelar adesão -->
                    <div class="row input-parcelas">
                        <div class="col-md-3 noPadding text-right">
                            <label id="total_parcelado">Parcelar adesão</label>
                        </div>

                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="input-group form-group">
                                            <div class="input-group-addon">R$</div>
                                            <input type="text" class="form-control ls-price" id="preco_parcelado" placeholder="0,00"  name="price_installment" value="{{ old('price_installment') }}" aria-required="true">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group select-parcelas">
                                        <select name="installments" id="parcelas" class="form-control selectpicker">
                                            <option value="" @if(old('installments') == '') selected @endif>--</option>
                                            <option value="2" @if(old('installments') == '2') selected @endif>2x</option>
                                            <option value="3" @if(old('installments') == '3') selected @endif>3x</option>
                                            <option value="4" @if(old('installments') == '4') selected @endif>4x</option>
                                            <option value="5" @if(old('installments') == '5') selected @endif>5x</option>
                                            <option value="6" @if(old('installments') == '6') selected @endif>6x</option>
                                            <option value="7" @if(old('installments') == '7') selected @endif>7x</option>
                                            <option value="8" @if(old('installments') == '8') selected @endif>8x</option>
                                            <option value="9" @if(old('installments') == '9') selected @endif>9x</option>
                                            <option value="10" @if(old('installments') == '10') selected @endif>10x</option>
                                            <option value="11" @if(old('installments') == '11') selected @endif>11x</option>
                                            <option value="12" @if(old('installments') == '12') selected @endif>12x</option>
                                            <option value="13" @if(old('installments') == '13') selected @endif>13x</option>
                                            <option value="14" @if(old('installments') == '14') selected @endif>14x</option>
                                            <option value="15" @if(old('installments') == '15') selected @endif>15x</option>
                                            <option value="16" @if(old('installments') == '16') selected @endif>16x</option>
                                            <option value="17" @if(old('installments') == '17') selected @endif>17x</option>
                                            <option value="18" @if(old('installments') == '18') selected @endif>18x</option>
                                        </select>
                                    </div>
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

                    <!-- Permitir teste grátis -->
                    <div class="row input-trial">
                        <div class="col-md-3 noPadding text-right">
                            <label for="trial">Permitir teste grátis</label>
                        </div>

                        <div class="col-md-9">
                            <div class="row mr-b-0">
                                <div class="col-md-3">
                                    <div class="input-group form-group mr-b-0">
                                        <input type="text" class="form-control" id="trial" name="trial" value="{{ old('trial') }}" aria-required="true">
                                        <div class="input-group-addon">dia(s)</div>
                                    </div>
                                    <label class="error" for="trial" style="display:none;"></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="mr-b-0">Deixe em branco ou digite "0" para desativar o período de testes.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Módulo -->
                <div class="formulario mr-t-20 bg-white p-3 border-radius-3">
                    <h6 class="mr-b-20 mr-t-0">
                        <i class="icone-puzzle"></i>
                        Integração e Módulos
                    </h6>

                    <!-- Módulo Select -->
                    <div class="row">
                        <div class="col-md-3 noPadding text-right">
                            <label for="modulo">Módulo</label>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <select name="module" id="modulo" class="form-control selectpicker select-module">
                                    <option value="">Nenhum</option>
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
                    </div>

                    <!-- Servidor Select -->
                    <div class="row">
                        <div class="col-md-3 noPadding text-right">
                            <label for="servidor">Servidor</label>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <select name="servidor" id="servidor" class="form-control selectpicker">
                                    <option value="">Selecione o Módulo</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Nenhum resultado -->
                    <div class="no-subs mr-t-0 pd-t-20 load-module" style="min-height: 50px;">
                        <div class="no-row-msg">
                            <svg class="empty" id="Layer_1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path fill="#999" d="M454 135.9l-.1-3.9H377v-19.1c0-2.2-1.8-3.9-4.1-3.9h-25.3c-2.2 0-3.7 1.7-3.7 3.9V132H197v-19.1c0-2.2-1.8-3.9-4.1-3.9h-25.3c-2.2 0-3.7 1.7-3.7 3.9V132H95v1h-.6l.1 4.2c.3 4.6.5 9.2.5 13.8v40.7c0 27.5-3.6 55-8.4 82-6 33.9-15 67.5-27 99.9l-2.2 5.3 37.5.4v24.2l357.6-.5.2-3.9c1.1-39.9 1.8-80.2 2.1-120.1.4-47.5.1-95.6-.8-143.1zM189 117v30.7c0 3.2-2.7 6.3-5.9 6.3h-5.6c-3.2 0-5.5-3.1-5.5-6.3V117h17zm180 0v30.7c0 3.2-2.7 6.3-5.9 6.3h-5.6c-3.2 0-5.5-3.1-5.5-6.3V117h17zm-265.8 24l60.8.2v6.5c0 7.6 5.9 14.3 13.5 14.3h5.6c7.6 0 13.9-6.7 13.9-14.3v-6.4l147 .4v6c0 7.6 5.9 14.3 13.5 14.3h5.6c7.6 0 13.9-6.7 13.9-14.3v-5.9l66.1.2c.3 46.1-3.4 92.5-11.1 137.8-5.4 32-12.9 64-22.3 95.2l-340.5-4c11.2-31.2 19.8-63.4 25.6-95.9 7.9-44.1 10.7-89.2 8.4-134.1zM447 279c-.2 38.5-1.1 77.5-2.1 116l-341.9.5v-16.1l312.3 3.6 1-2.9c9.9-32.4 17.8-65.7 23.4-99 3-17.8 5.5-35.8 7.3-53.8.1 17.3.1 34.5 0 51.7z"></path>
                                <circle fill="#999" cx="217.4" cy="229" r="13.9"></circle>
                                <circle fill="#999" cx="309.1" cy="229" r="13.9"></circle>
                                <path fill="#999" d="M192 326.5c.8 0 1.7-.3 2.4-.8 13.9-10.6 30.2-18.1 47.2-21.8 24.1-5.1 44.9-1.6 58 2.3 2.1.6 4.3-.6 5-2.7.6-2.1-.6-4.3-2.7-5-14-4.2-36.2-7.9-62-2.5-18.1 3.9-35.6 11.9-50.4 23.2-1.8 1.3-2.1 3.9-.7 5.6.8 1.2 2 1.7 3.2 1.7z"></path>
                            </svg>

                            <span>Escolha um módulo para carregar configurações</span>
                        </div>
                    </div>
                    <!-- Fim Nenhum Resultado -->
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
                            Salvar plano
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