<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon.png') }}">
    <!--<link rel="stylesheet" href="{{ asset('assets/css/pace.css') }}">-->

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>GerentePRO - Painel de Administração</title>

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900|Montserrat:300,400,500,600,700,800,900|Raleway:300,400,500,600,700,800,900|Roboto:300,400,500,700,900" rel="stylesheet">
    <link href="{{ asset('assets/vendors/material-icons/material-icons.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/vendors/mono-social-icons/monosocialiconsfont.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/vendors/feather-icons/feather.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/fontello.css') }}" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/0.7.0/css/perfect-scrollbar.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick-theme.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/2.1.25/daterangepicker.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ajax-bootstrap-select/1.3.8/css/ajax-bootstrap-select.min.css" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/multi-select/0.9.12/css/multi-select.min.css" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
    <!--<script data-pace-options='{ "ajax": false, "selectors": [ "img" ]}' src="https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js"></script>-->

</head>
<body class="sidebar-dark sidebar-expand navbar-brand-dark header-light" data-id="{{ AccountId() }}">
    <div id="wrapper" class="wrapper">
        <!--
        <div class="alert alert-trial text-center">
            Você está no período de teste do GerentePRO. Ligue agora, é grátis 0800 007 0017
            <a href="#" class="btn btn-primary">
                Contratar agora
            </a>
        </div>
        -->

        <!-- HEADER & TOP NAVIGATION -->
        <nav class="navbar">
            <!-- Logo Area -->
            <div class="navbar-header">
                <a href="index.html" class="navbar-brand">
                    <img class="logo-expand" alt="" src="{{ asset('images/logo-dark.png') }}">
                    <img class="logo-collapse" alt="" src="{{ asset('assets/img/logo-collapse.png') }}">
                    <!-- <p>BonVue</p> -->
                </a>
            </div>

            <ul class="nav navbar-nav">
                <li class="sidebar-toggle dropdown">
                    <a href="javascript:void(0)" class="ripple"><i class="feather feather-menu list-icon fs-20"></i></a>
                </li>
            </ul>

            <div class="spacer"></div>
            <!-- Right Menu -->
            <ul class="nav navbar-nav d-none d-lg-flex ml-2 ml-0-rtl">

                <!-- Notificações -->
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="feather feather-bell list-icon"></i>
                        <span class="button-pulse bg-danger"></span>
                    </a>

                    <div class="dropdown-menu dropdown-left dropdown-card animated flipInY">
                        <div class="card">
                            <header class="card-header d-flex justify-content-between mb-0">
                                <span class="heading-font-family flex-1 text-center fw-400">Notificações</span>
                            </header>

                            <ul class="card-body list-unstyled dropdown-list-group">
                                <!-- Lista das Notificações -->
                                <li>
                                    <a href="#" class="media">
                                        <span class="d-flex">
                                            <i class="material-icons list-icon">check</i>
                                        </span>

                                        <span class="media-body">
                                            <span class="heading-font-family media-heading">Invitation accepted</span>
                                            <span class="media-content">Your have been Invited ...</span>
                                        </span>
                                    </a>
                                </li>

                                <li>
                                    <a href="#" class="media">
                                        <span class="d-flex thumb-xs user--online">
                                            <img src="{{ asset('assets/demo/users/user3.jpg')}}" class="rounded-circle" alt="">
                                        </span>

                                        <span class="media-body">
                                            <span class="heading-font-family media-heading">Steve Smith</span>
                                            <span class="media-content">I slowly updated projects</span>
                                        </span>
                                    </a>
                                </li>

                                <li>
                                    <a href="#" class="media">
                                        <span class="d-flex">
                                            <i class="material-icons list-icon">event_available</i>
                                        </span>

                                        <span class="media-body">
                                            <span class="-heading-font-family media-heading">To Do</span>
                                            <span class="media-content">Meeting with Nathan on Friday 8 AM ...</span>
                                        </span>
                                    </a>
                                </li>
                                <!-- /.dropdown-list-group -->
                            </ul>

                            <footer class="card-footer text-center">
                                <a href="javascript:void(0);" class="headings-font-family fs-13">Ver todas as notificações</a>
                            </footer>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.dropdown-menu -->
                </li>
                <!-- /.Notificações -->

                <li>
                    <a href="{{ route('config.index') }}">
                        <i class="feather feather-settings list-icon"></i>
                        Configurações
                    </a>
                </li>
            </ul>

            <!-- Perfil -->
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle dropdown-toggle-user ripple" data-toggle="dropdown">
                        <span class="avatar thumb-xs2">
                            <img src="{{ asset('assets/demo/users/user1.jpg') }}" class="rounded-circle" alt="">
                            <i class="feather feather-chevron-down list-icon"></i>
                        </span>
                    </a>

                    <div class="dropdown-menu dropdown-left dropdown-card dropdown-card-profile animated flipInY">
                        <div class="card">
                            <header class="card-header d-flex mb-0">
                                <b>Lucas Maia</b>
                                <span>lucas.codemax@gmail.com</span>
                            </header>

                            <ul class="list-unstyled card-body">
                                <li>
                                    <a href="#">
                                        <span><span class="align-middle">Meu GerentePRO</span></span>
                                    </a>
                                </li>

                                <li>
                                    <a href="#">
                                        <span><span class="align-middle">Alterar Senha</span></span>
                                    </a>
                                </li>

                                <li>
                                    <a href="#">
                                        <span><span class="align-middle">Central de Cliente</span></span>
                                    </a>
                                </li>

                                <li>
                                    <a href="#">
                                        <span><span class="align-middle">Sair</span></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </nav>

        <div class="content-wrapper">

            <!-- Menu Sidebar -->
            <aside class="site-sidebar scrollbar-enabled" data-suppress-scroll-x="true">

                <nav class="sidebar-nav">
                    <ul class="nav in side-menu">
                        <li class="{{ Route::currentRouteName() == 'home' ? 'active ' : ''}}">
                            <a href="{{ route('home') }}">
                                <i class="list-icon feather feather-command"></i>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>

                        <!-- Menu Clientes -->
                        <li class="menu-item-has-children {{ Request::segment(2) == 'clientes' ? 'active ' : ''}}">
                            <a href="javascript:void(0);">
                                <i class="list-icon feather feather-user"></i>
                                <span class="hide-menu">Cadastros</span>
                            </a>

                            <ul class="list-unstyled sub-menu collapse {{ Request::segment(2) == 'clientes' ||  Request::segment(2) == 'fornecedores' ? 'in' : '' }}">

                                <li class="{{ Route::currentRouteName() == 'customers.index' ? 'active ' : ''}}">
                                    <a href="{{ route('customers.index') }}">
                                        <span class="hide-menu">Clientes</span>
                                    </a>
                                </li>

                                <li class="{{ Route::currentRouteName() == 'providers.index' ? 'active ' : ''}}">
                                    <a href="{{ route('providers.index') }}">
                                        <span class="hide-menu">Fornecedores</span>
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ route('subscriptions.index') }}">
                                        <span class="hide-menu">Assinaturas Ativas</span>
                                    </a>
                                </li>

                                <li>
                                    <a href="#">
                                        <span class="hide-menu">Assinaturas em Cortesia</span>
                                    </a>
                                </li>

                                <li class="{{ Route::currentRouteName() == 'cancellations.index' ? 'active ' : ''}}">
                                    <a href="{{ route('cancellations.index') }}">
                                        <span class="hide-menu">Cancelamentos</span>
                                    </a>
                                </li>

                                <li class="{{ Route::currentRouteName() == 'abandoned_carts.index' ? 'active ' : ''}}">
                                    <a href="{{ route('abandoned_carts.index') }}">
                                        <span class="hide-menu">Carrinhos Abandonados</span>
                                    </a>
                                </li>

                                <li>
                                    <a href="#">
                                        <span class="hide-menu">Registros de Domínios</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Menu Financeiro -->
                        <li class="menu-item-has-children {{ Request::segment(2) == 'financeiro' ? 'active ' : ''}}">
                            <a href="javascript:void(0);">
                                <i class="list-icon feather feather-briefcase"></i>
                                <span class="hide-menu">Financeiro</span>
                            </a>

                            <ul class="list-unstyled sub-menu collapse {{ Request::segment(2) == 'financeiro' ? 'in' : '' }}">
                                <li class="{{ Route::currentRouteName() == 'invoices.resume' ? 'active ' : ''}}">
                                    <a href="{{ route('invoices.resume') }}">Resumo Financeiro</a>
                                </li>
                                <li class="{{ Route::currentRouteName() == 'invoices.index' ? 'active ' : ''}}">
                                    <a href="{{ route('invoices.index') }}">Faturas</a>
                                </li>
                                <li class="{{ Route::currentRouteName() == 'debits.index' ? 'active ' : ''}}">
                                    <a href="{{ route('debits.index') }}">Contas à Pagar</a>
                                </li>
                                <li class="{{ Route::currentRouteName() == 'config.plans.index' ? 'active ' : ''}}">
                                    <a href="{{ route('config.plans.index') }}">Planos de Assinatura</a>
                                </li>
                                <li class="{{ Route::currentRouteName() == 'config.optionals.index' ? 'active ' : ''}}">
                                    <a href="{{ route('config.optionals.index') }}">Opcionais</a>
                                </li>
                                <li>
                                    <a href="#">Cupons de Desconto</a>
                                </li>
                            </ul>
                        </li>

                        <!-- Menu Helpdesk -->
                        <li class="menu-item-has-children">
                            <a href="javascript:void(0);">
                                <i class="list-icon feather feather-anchor"></i>
                                <span class="hide-menu">Helpdesk</span>
                            </a>

                            <ul class="list-unstyled sub-menu collapse {{ Request::segment(2) == 'helpdesk' ? 'in' : '' }}">
                                <li>
                                    <a href="page-blank.html">Download</a>
                                </li>
                                <li>
                                    <a href="../default/page-sitemap.html">Base de Conhecimento</a>
                                </li>
                                <li class="menu-item-has-children">
                                    <a href="javascript:void(0);">Tickets de Suporte</a>
                                    <ul class="list-unstyled sub-menu">
                                        <li>
                                            <a href="../default/email-templates/basic.html">Aberto</a>
                                        </li>
                                        <li>
                                            <a href="../default/email-templates/billing.html">Respondido</a>
                                        </li>
                                        <li>
                                            <a href="../default/email-templates/billing.html">Em processo</a>
                                        </li>
                                        <li>
                                            <a href="../default/email-templates/friend-request.html">Aguardando</a>
                                        </li>
                                        <li>
                                            <a href="../default/email-templates/friend-request.html">Finalizado</a>
                                        </li>
                                    </ul>
                                </li>

                                <li>
                                    <a href="../default/page-lightbox.html">Departamentos</a>
                                </li>

                                <li>
                                    <a href="../default/page-lightbox.html">Respostas pré-definidas</a>
                                </li>
                            </ul>

                        </li>

                        <!-- Menu Relatórios -->
                        <li class="">
                            <a href="{{ route('reports.index') }}">
                                <i class="list-icon feather feather-bar-chart-2"></i>
                                <span class="hide-menu">Relatórios</span>
                            </a>
                        </li>

                        <!-- Menu Integrações -->
                        <li class="{{ Route::currentRouteName() == 'plugins.index' ? 'active ' : ''}}">
                            <a href="{{ route('plugins.index') }}">
                                <i class="list-icon feather feather-layers"></i>
                                <span class="hide-menu">Integrações</span>
                            </a>
                        </li>

                        <!-- Menu Ajuda -->
                        <li class="menu-item-has-children">
                            <a href="javascript:void(0);">
                                <i class="list-icon feather feather-info"></i>
                                <span class="hide-menu">Ajuda</span>
                            </a>

                            <ul class="list-unstyled sub-menu collapse {{ Request::segment(2) == 'ajuda' ? 'in' : '' }}">
                                <li>
                                    <a href="../default/ui-typography.html">Documentação</a>
                                </li>
                                <li>
                                    <a href="../default/ui-buttons.html">O que há de novo?</a>
                                </li>
                                <li>
                                    <a href="../default/ui-cards.html">Solicitação de Suporte</a>
                                </li>
                                <li>
                                    <a href="../default/ui-tabs.html">Atualizações</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <!-- /.side-menu -->
                </nav>
                <!-- /.sidebar-nav -->
            </aside>
            <!-- /.Fim do Menu -->

            <!-- Conteúdo -->
            <main class="main-wrapper clearfix">
                @yield('content')
            </main>
        </div>
        <!-- /.content-wrapper -->
    </div>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.2/umd/popper.min.js"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/metisMenu/2.7.0/metisMenu.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/0.7.0/js/perfect-scrollbar.jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/countup.js/1.9.2/countUp.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-circle-progress/1.2.2/circle-progress.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-sparklines/2.1.2/jquery.sparkline.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/2.1.25/daterangepicker.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mithril/1.1.1/mithril.js"></script>
    <script src="{{ asset('assets/vendors/theme-widgets/widgets.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ajax-bootstrap-select/1.3.8/js/ajax-bootstrap-select.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/multi-select/0.9.12/js/jquery.multi-select.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/additional-methods.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/localization/messages_pt_BR.min.js"></script>

    <!--<script src="{{ asset('js/plugins/jquery-ui/jquery-ui.min.js') }}"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>
    <script src="{{ asset('js/jquery.mask.money.js') }}"></script>
    <script src="{{ asset('assets/js/theme.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    @extends('layouts.modal')

    <script type="text/javascript">
        $.fn.datepicker.dates['en'] = {
            days: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
            daysShort: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sab"],
            daysMin: ["Do", "Se", "Te", "Qa", "Qu", "Se", "Sa"],
            months: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"],
            monthsShort: ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"],
            today: "Hoje",
            clear: "Limpar",
            format: "dd/mm/yyyy",
            titleFormat: "MM yyyy", /* Leverages same syntax as 'format' */
            weekStart: 0,
            startDate: '-0d',
        };

    </script>

</body>
</html>