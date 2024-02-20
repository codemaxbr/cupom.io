@extends('layouts.sistema')
@section('content')
    <!-- Page Title Area -->
    <div class="row page-title clearfix">
        <div class="page-title-left">
            <h6 class="page-title-heading mr-0 mr-r-5">Cancelamento de Assinatura</h6>
            <p class="page-title-description mr-0 d-none d-md-inline-block"></p>
        </div>
        <!-- Breadcrumb -->
        <div class="page-title-right d-none d-sm-inline-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.html">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="index.html">Clientes</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="index.html">Assinaturas</a>
                </li>
                <li class="breadcrumb-item active">#{{--$cancelamento->id--}}</li>
            </ol>
        </div>
    </div>
    <!-- =================================== -->
    <!-- Different data widgets ============ -->
    <!-- =================================== -->
    <div class="widget-list">
        <div class="row">
            <!-- Tabs Content -->
            <div class="content-with-sidebar">
                <div class="tab-content bg-none p-0">
                    <div class="detalhes mr-t-20 bg-white p-3 border-radius-3">
                        <h6 class="mr-b-10 mr-t-0 fs-22">
                            <i class="fa fa-globe mr-r-5"></i>
                            {{--}}@if($assinatura->domain != NULL)
                                {{ $assinatura->domain }}
                            @else
                                Detalhes do Cancelamento
                            @endif--}}
                            Detalhes do Cancelamento
                        </h6>
                        <div class="box-info-grid">
                            <div class="row detalhes">
                                <div class="col-md-12">
                                    <div class="row fs-15">
                                        <div class="col-md-5 text-right"></div>
                                        <div class="col-md-7 no-padding-left">
                                            <img src="{{ asset('images/modules/panel/folhadirigida.png') }}" class="mr-b-10" style="max-height: 40px;" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row detalhes">
                                <div class="col-md-12">
                                    <div class="row bg-white p-1">
                                        <div class="col-md-5 text-right">
                                            <b>ID:</b>
                                        </div>
                                        <div class="col-md-6 no-padding-left">
                                            {{--$cancelamento->id--}}
                                        </div>
                                    </div>
                                    <div class="row bg-white p-1">
                                        <div class="col-md-5 text-right">
                                            <b>Plano Cancelado:</b>
                                        </div>
                                        <div class="col-md-6 no-padding-left">
                                            {{--$cancelamento->plan->name--}}
                                        </div>
                                    </div>
                                    <div class="row bg-white p-1">
                                        <div class="col-md-5 text-right">
                                            <b>Valor:</b>
                                        </div>
                                        <div class="col-md-6 no-padding-left">
                                            {{--$cancelamento->total--}}
                                        </div>
                                    </div>
                                    <div class="row bg-white p-1">
                                        <div class="col-md-5 text-right">
                                            <b>Data de Ativação:</b>
                                        </div>
                                        <div class="col-md-6 no-padding-left">
                                            <i class="icone-calendar"></i>
                                            {{--$cancelamento->id--}}
                                        </div>
                                    </div>
                                    <div class="row bg-white p-1">
                                        <div class="col-md-5 text-right">
                                            <b>Data de Cancelamento:</b>
                                        </div>
                                        <div class="col-md-6 no-padding-left">
                                            <i class="icone-calendar"></i>
                                        </div>
                                    </div>
                                    <div class="row bg-white p-1">
                                        <div class="col-md-5 text-right">
                                            <b>Motivo do Cancelamento:</b>
                                        </div>
                                        <div class="col-md-6 no-padding-left">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Serviços adicionais @todo Continuar depois, esqueci o caderno em casa -->
                    <div class="adicionais mr-t-20 bg-white p-3 border-radius-3">
                        <h6 class="mr-b-10 mr-t-0">
                            <i class="icone-info-circled-1"></i>
                            Algo Aqui
                        </h6>
                        Nenhum serviço contratado
                    </div>
                    <!-- Fim Serviços adicionais -->
                </div>
                <!--./tab-content -->
            </div>
            <!-- /.col-sm-8 -->
            <!-- User Actions -->
            <div class="actions-sidebar">
                <!-- Endereços -->
                <div class="widget-bg widget-notes mr-t-20 border-radius-3">
                    <div class="widget-body profile-user-description p-3">
                        <h6 class="mr-t-0">
                            <i class="icone-user-1 fs-16"></i>
                            Dados do assinante
                        </h6>
                        <a href="#">{{-- $assinatura->customer->name --}}</a><br />
                        {{-- $assinatura->customer->email--}}

                        <div class="contact-details-cell text-left mr-t-10">
                            <p class="mr-b-0 w-100">
                                <small class="heading-font-family fw-500">Endereço de Cobrança</small><br />
                                {{--}} @if($assinatura->customer->address != null)
                                     {{ $assinatura->customer->address.", ".$assinatura->customer->number }}<br />
                                     {{ $assinatura->customer->additional." - ".$assinatura->customer->district }}<br />
                                     {{ $assinatura->customer->city.", ".$assinatura->customer->uf." - ".$assinatura->customer->zipcode }}<br />
                                     Brasil<br />
                                     <a href="#" class="fs-13 d-block text-center">
                                         <i class="fa fa-map-marker"></i>
                                         <b>Ver no mapa</b>
                                     </a>
                                 @else
                                     Sem dados de endereço
                                 @endif--}}
                            </p>
                        </div>
                    </div>
                </div>
                <!-- ./ Endereços -->

                <!-- Cartões -->
                <div class="widget-bg widget-notes mr-t-20 border-radius-3">
                    <div class="widget-body profile-user-description p-3">
                        <h6 class="mr-t-0">
                            <i class="icone-info-circled-1"></i>
                            Outra coisa AQUI
                        </h6>

                        <div class="contact-details-cell text-left">
                            <p class="mr-b-0 w-100">
                            </p>
                        </div>
                    </div>
                </div>
                <!-- ./ Cartões -->
            </div>
        </div>
    </div>
    <!--
    @todo Criar modal para Cancelamento
    @todo Criar modal para Alterar o plano
    @todo Criar modal para Alterar o vencimento
    @todo Criar modal para função Suspender
    -->
@endsection