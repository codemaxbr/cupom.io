@extends('layouts.sistema')
@section('content')

    <!-- Page Title Area -->
    <div class="row page-title clearfix">
        <div class="page-title-left">
            <h6 class="page-title-heading mr-0 mr-r-5">Plano de assinatura</h6>
        </div>

        <!-- Breadcrumb -->
        <div class="page-title-right d-none d-sm-inline-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('config.plans.index') }}">Configurações</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="index.html">Planos</a>
                </li>
                <li class="breadcrumb-item active">Novo</li>
            </ol>
        </div>
    </div>

    <!-- =================================== -->
    <!-- Different data widgets ============ -->
    <!-- =================================== -->
    <form class="widget-list" id="config-plans-add" method="post" action="{{ route('config.plans.edit.submit', $plano->id) }}">

        @csrf
        @method('PUT')
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
                            <input class="form-control" type="text" id="nome" name="name" value="{{$plano->name or old('name')}}" required aria-required="true">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 noPadding text-right">
                            <label for="tipo">Tipo <b class="text-red">*</b></label>
                        </div>
                        <div class="col-md-3 form-group">
                            <select name="type_plan_id" id="tipo" class="form-control selectpicker">
                               @foreach($tipos as $tipo)
                                    <option value="{{$tipo->id}}" @if($plano->type_plan->id == $tipo->id) selected="selected" @endif>
                                        {{$tipo->name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 noPadding text-right">
                            <label for="descricao">Descrição</label>
                        </div>
                        <div class="col-md-7 form-group">
                            <textarea name="description" id="descricao" class="form-control" style="height: 150px; resize: none;">{{$plano->description or old('description')}}</textarea>
                        </div>
                    </div>

                    <!-- Email de Boas-vindas -->
                    <div class="row">
                        <div class="col-md-3 noPadding text-right">
                            <label for="email_template">E-mail de boas-vindas</label>
                        </div>

                        <div class="col-md-5">
                            <select name="email_template_id" id="email_template" class="form-control selectpicker">
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
                                        <input type="text" class="form-control ls-price" id="preco" name="price" required value="{{$plano->price or old('price') }}" placeholder="0,00">
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
                                            <option value="" @if($plano->installments =='' or old('installments') == '') selected @endif>--</option>
                                            <option value="2" @if($plano->installments =='2' or old('installments') == '2') selected @endif>2x</option>
                                            <option value="3" @if($plano->installments =='3' or old('installments') == '3') selected @endif>3x</option>
                                            <option value="4" @if($plano->installments =='4' or old('installments') == '4') selected @endif>4x</option>
                                            <option value="5" @if($plano->installments =='5' or old('installments') == '5') selected @endif>5x</option>
                                            <option value="6" @if($plano->installments =='6' or old('installments') == '6') selected @endif>6x</option>
                                            <option value="7" @if($plano->installments =='7' or old('installments') == '7') selected @endif>7x</option>
                                            <option value="8" @if($plano->installments =='8' or old('installments') == '8') selected @endif>8x</option>
                                            <option value="9" @if($plano->installments =='9' or old('installments') == '9') selected @endif>9x</option>
                                            <option value="10" @if($plano->installments =='10' or old('installments') == '10') selected @endif>10x</option>
                                            <option value="11" @if($plano->installments =='11' or old('installments') == '11') selected @endif>11x</option>
                                            <option value="12" @if($plano->installments =='12' or old('installments') == '12') selected @endif>12x</option>
                                            <option value="13" @if($plano->installments =='13' or old('installments') == '13') selected @endif>13x</option>
                                            <option value="14" @if($plano->installments =='14' or old('installments') == '14') selected @endif>14x</option>
                                            <option value="15" @if($plano->installments =='15' or old('installments') == '15') selected @endif>15x</option>
                                            <option value="16" @if($plano->installments =='16' or old('installments') == '16') selected @endif>16x</option>
                                            <option value="17" @if($plano->installments =='17' or old('installments') == '17') selected @endif>17x</option>
                                            <option value="18" @if($plano->installments =='18' or old('installments') == '18') selected @endif>18x</option>
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
                                                <option value="{{ $ciclo->id }}" @if($plano->payment_cycle->id == $ciclo->id) selected="selected" @endif>
                                                    {{ $ciclo->name }}
                                                </option>
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
                                        <input type="text" class="form-control" id="trial" name="trial" value="{{$plano->trial or old('trial') }}" aria-required="true">
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
                                        <option value="1" @if($plano->visibility == 1) selected="selected" @endif>Público</option>
                                        <option value="2" @if($plano->visibility == 2) selected="selected" @endif>Apenas para assinantes</option>
                                        <option value="3" @if($plano->visibility == 3) selected="selected" @endif>Apenas para novas assinaturas</option>
                                        <option value="0" @if($plano->visibility == 0) selected="selected" @endif>Desativado</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-block btn-primary mr-b-10">
                            Alterar plano
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
        });
    </script>
@endsection