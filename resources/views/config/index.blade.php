@extends('layouts.sistema')
@section('content')
    <!-- Page Title Area -->
    <div class="row page-title clearfix">
        <div class="page-title-left">
            <h6 class="page-title-heading mr-0 mr-r-5">Configurações</h6>
            <!--<p class="page-title-description mr-0 d-none d-md-inline-block">statistics, charts and events</p>-->
        </div>
        <!-- /.page-title-left -->
        <div class="page-title-right d-none d-sm-inline-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Configurações</li>
            </ol>
        </div>
        <!-- /.page-title-right -->
    </div>
    <!-- /.page-title -->

    <!--
    <div class="alert alert-danger">
        <i class="icone-attention"></i>
        Você não tem permissão para alterar configurações, porém você pode visualizar.
    </div>
    -->

    <div class="row mr-t-10">

        <div class="col-md-4">
            <div class="widget-bg widget-notes border-radius-3">
                <div class="widget-body profile-user-description p-3">
                    <h6 class="mr-t-0">
                        Minha conta
                    </h6>

                    <div class="contact-details-cell text-left">
                        <p class="mr-b-0 w-100">
                            <a href="{{ route('config.my-account') }}" class="fw-600 fs-15 d-block">
                                <i class="icone-right-dir f-left"></i>
                                Meu GerentePRO
                            </a>
                        </p>
                    </div>

                    <div class="contact-details-cell text-left">
                        <p class="mr-b-0 w-100">
                            <a href="{{ route('config.account.portal') }}" class="fw-600 fs-15 d-block">
                                <i class="icone-right-dir f-left"></i>
                                Central de cliente
                            </a>
                            Selecione como e quando serão feitas os envios de cobrança para o cliente.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="widget-bg widget-notes border-radius-3">
                <div class="widget-body profile-user-description p-3">
                    <h6 class="mr-t-0">
                        Financeiro
                    </h6>

                    <div class="contact-details-cell text-left">
                        <p class="mr-b-0 w-100">
                            <a href="{{ route('config.method-payment') }}" class="fw-600 fs-15 d-block">
                                <i class="icone-right-dir f-left"></i>
                                Método de pagamento
                            </a>
                            Você pode selecionar um gateway padrão para cada tipo de pagamento.
                        </p>
                    </div>

                    <div class="contact-details-cell text-left">
                        <p class="mr-b-0 w-100">
                            <a href="#" class="fw-600 fs-15 d-block">
                                <i class="icone-right-dir f-left"></i>
                                Faturas
                            </a>
                            Selecione como e quando serão feitas os envios de cobrança para o cliente.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="widget-bg widget-notes border-radius-3">
                <div class="widget-body profile-user-description p-3">
                    <h6 class="mr-t-0">
                        Controle de Usuários
                    </h6>

                    <div class="contact-details-cell text-left">
                        <p class="mr-b-0 w-100">
                            <a href="{{ route('config.users') }}" class="fw-600 fs-15 d-block">
                                <i class="icone-right-dir f-left"></i>
                                Usuários
                            </a>
                            Gerencie quem pode ter acesso ao Painel de Administração.
                        </p>
                    </div>

                    <div class="contact-details-cell text-left">
                        <p class="mr-b-0 w-100">
                            <a href="{{ route('config.users.group') }}" class="fw-600 fs-15 d-block">
                                <i class="icone-right-dir f-left"></i>
                                Grupos e Permissões
                            </a>
                            Defina permissões de acesso para grupos e usuários específicos.
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection