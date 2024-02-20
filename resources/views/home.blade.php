@extends('layouts.sistema')

@section('content')
    <!-- Page Title -->
    <div class="row page-title clearfix">
        <div class="page-title-left">
            <h6 class="page-title-heading mr-0 mr-r-5">Dashboard</h6>
            <p class="page-title-description mr-0 d-none d-md-inline-block">Quarta-feira, 13 de Junho de 2018</p>
        </div>

        <!-- Breadcrumb -->
        <div class="page-title-right d-none d-sm-inline-flex">
            <a href="#">
                <i class="icone-youtube-play fs-15"></i>
                Como funciona? Veja nosso passo a passo.
            </a>
        </div>
    </div>
    <!-- /.page-title -->

    @if(!$hasConfig or !$hasGateway)
        <div class="alert alert-warning pd-b-20">
            <h5 class="mr-t-5"><i class="fa fa-warning mr-r-5"></i> Você tem <b>{{ $countPlans }}</b> planos de assinatura que não poderão ser contratados.</h5>

            @if(!$hasGateway)
                <div class="alert alert-danger mr-b-5">
                    <b>1.</b> Você não completou a integração de gateway de pagamento. <a href="{{ route('plugins.index') }}" class="fw-bold">Ir para Integrações</a>
                </div>
            @endif

            @if(!$hasConfig)
                <div class="alert alert-danger mr-b-10">
                    <b>2.</b> Configurações de pagamento, não definido. <a href="{{ route('config.method-payment') }}" class="fw-bold">Ir para Configurações de Pagamento</a>
                </div>
            @endif

            Se preferir, siga este passo a posso para concluir as configurações. <a href="#">Saiba como <i class="icone-question mr-l-5"></i></a>

        </div>
    @endif

    <!-- =================================== -->
    <!-- Different data widgets ============ -->
    <!-- =================================== -->
    <div class="widget-list row">

        <!-- Widget = Novos Clientes -->

        <!-- ASSINATURAS vs CANCELAMENTOS -->
        <div class="widget-holder widget-full-height widget-flex col-lg-8">
            <div class="widget-bg">
                <div class="widget-heading">
                    <h5 class="widget-title">
                        ASSINATURAS <font class="fw-400 mr-lr-5">vs</font> CANCELAMENTOS
                    </h5>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-input-icon">
                                <i class="fa fa-calendar list-icon"></i>
                                <input class="form-control daterange" id="l6" placeholder="Período" type="text">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="widget-body">
                    <div class="mr-t-10 flex-1">
                        <div style="max-height: 270px; height: 270px">
                            <canvas id="chartJsNewUsers" style="height:100%"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ASSINATURAS -->
        <div class="widget-holder widget-full-content col-lg-4">
            <div class="widget-bg">
                <div class="widget-heading">
                    <h5 class="widget-title">ASSINATURAS</h5>
                </div>

                <div class="widget-body pd-lr-20 pd-t-10 pd-b-20">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4">
                                <p class="pd-t-10 mr-b-0">Hoje</p>
                                <h5 class="mr-b-5 mr-t-0"><span class="counter">10039</span></h5>
                            </div>

                            <div class="col-md-4">
                                <p class="pd-t-10 mr-b-0">Ontem</p>
                                <h5 class="mr-b-5 mr-t-0"><span class="counter">10057</span></h5>
                            </div>

                            <div class="col-md-4">
                                <p class="pd-t-10 mr-b-0">Este mês</p>
                                <h5 class="mr-b-5 mr-t-0"><span class="counter">100482</span></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FATURAMENTO -->
            <div class="widget-bg mr-t-10">
                <div class="widget-heading">
                    <h5 class="widget-title">FATURAMENTO</h5>
                </div>

                <div class="widget-body pd-lr-20 pd-t-10 pd-b-20">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="text-blue mr-0 fw-600">
                                R$ 125.210,00
                            </h3>
                            <p>Mês atual: <b class="text-dark fw-400">Outubro/2018</p>
                        </div>
                    </div>

                    <!-- Mês anterior -->
                    <div class="row mr-t-5">
                        <div class="col-md-6 bg-gray1 pd-tb-5 pd-l-10 fs-16">
                            Mês anterior
                        </div>
                        <div class="col-md-6 text-right bg-gray1 pd-tb-5 pd-r-10 fs-16">
                            <b>R$ 51.058,76</b>
                        </div>
                    </div>

                    <!-- Este ano -->
                    <div class="row mr-t-5">
                        <div class="col-md-6 bg-gray1 pd-tb-5 pd-l-10 fs-16">
                            Este ano
                        </div>
                        <div class="col-md-6 text-right bg-gray1 pd-tb-5 pd-r-10 fs-16">
                            <b>R$ 251.058,76</b>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.widget-list -->
    <hr>

    <div class="widget-list row">
        <div class="col-lg-8">
            <div class="row">
                <!-- Widget = Clientes Ativos -->
                <div class="widget-holder widget-sm col-md-4 widget-full-height">
                    <div class="widget-bg">
                        <div class="widget-body">
                            <div class="counter-w-info media">
                                <div class="media-body">
                                    <p class="text-muted mr-b-5">Assinaturas</p>
                                    <span class="counter-title color-primary">
                                        <span class="counter">2860</span>
                                    </span>

                                    <span class="counter-difference text-success">
                                        <i class="feather feather-arrow-up"></i>
                                        23%
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Widget = Lucro Mensal -->
                <div class="widget-holder widget-sm col-md-4 widget-full-height">
                    <div class="widget-bg">
                        <div class="widget-body">
                            <div class="counter-w-info media">
                                <div class="media-body">
                                    <p class="text-muted mr-b-5">Lucro Mensal</p>
                                    <span class="counter-title color-primary">
                                        <span class="counter">58</span>%
                                    </span>

                                    <span class="counter-difference text-danger">
                                        <i class="feather feather-arrow-down"></i> 8%
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Widget = Faturamento Mensal -->
                <div class="widget-holder widget-sm col-md-4 widget-full-height">
                    <div class="widget-bg">
                        <div class="widget-body">
                            <div class="counter-w-info media">
                                <div class="media-body">
                                    <p class="text-muted mr-b-5">Clientes ativos</p>
                                    <span class="counter-title color-primary">
                                        <span class="counter">83847</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Widget = Cancelamentos -->
                <div class="widget-holder widget-sm col-md-4 widget-full-height mr-t-5">
                    <div class="widget-bg">
                        <div class="widget-body">
                            <div class="counter-w-info media">
                                <div class="media-body">
                                    <p class="text-muted mr-b-5">Cancelamentos</p>
                                    <span class="counter-title color-primary">
                                        <span class="counter">0</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Widget = Taxa de churn -->
                <div class="widget-holder widget-sm col-md-4 widget-full-height mr-t-5">
                    <div class="widget-bg">
                        <div class="widget-body">
                            <div class="counter-w-info media">
                                <div class="media-body">
                                    <p class="text-muted mr-b-5">Taxa de churn</p>
                                    <span class="counter-title color-primary">
                                        <span class="counter">0</span>%
                                    </span>

                                    <span class="counter-difference text-danger">
                                        <i class="feather feather-arrow-down"></i> 8%
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Widget = Falhas no pagamento -->
                <div class="widget-holder widget-sm col-md-4 widget-full-height mr-t-5">
                    <div class="widget-bg">
                        <div class="widget-body">
                            <div class="counter-w-info media">
                                <div class="media-body">
                                    <p class="text-muted mr-b-5">Falhas no pagamento</p>
                                    <span class="counter-title color-primary">
                                        <span class="counter">0</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Widget = Taxa de Conversão -->
        <div class="widget-holder widget-full-content widget-full-height col-lg-4">
            <div class="widget-bg">
                <div class="widget-heading">
                    <h5 class="widget-title">TAXA DE CONVERSÃO</h5>
                    <div class="widget-graph-info">
                        <div class="dropdown">
                            <a href="javascript:void(0)" class="dropdown-toggle text-muted fs-16" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-ellipsis-v"></i>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="widget-body">
                    <div class="container-fluid pd-20">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="pos-relative" style="height: 200px">
                                    <canvas id="chartJsDoughnutLegend"></canvas>
                                    <span class="h6 fw-600 text-muted fs-13 text-uppercase m-0 absolute-center">Referência</span>
                                </div>

                                <div class="counter-info heading-font-family text-center mt-3 mb-3 fs-13">
                                            <span class="color-success">
                                                <i class="fa fa-arrow-circle-o-up"></i> <strong>34%</strong>
                                            </span>
                                    desde a semana passada
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <h5 class="h2 fw-semibold mt-0">58.3%</h5>
                                <div class="progress w-50 mb-3">
                                    <div class="progress-bar bg-info" style="background: linear-gradient(to right, #17bff0, #8be0f9); width: 58.3%" role="progressbar">
                                        <span class="sr-only">60% Complete</span>
                                    </div>
                                </div>

                                <p class="heading-font-family fs-13">de visitantes que foram <br />convertidos em clientes.</p>
                                <div class="row">
                                    <div class="col-6">
                                        <p class="heading-font-family fs-13 mb-3"><i class="fa fa-square mr-2 mr-0-rtl ml-2-rtl" style="color: #4671bd"></i> Google</p>
                                        <p class="heading-font-family fs-13 mb-3"><i class="fa fa-square mr-2 mr-0-rtl ml-2-rtl" style="color: #199bfc"></i> Facebook</p>
                                    </div>

                                    <div class="col-6">
                                        <p class="heading-font-family fs-13 mb-3"><i class="fa fa-square mr-2 mr-0-rtl ml-2-rtl" style="color: #54c273"></i> Youtube</p>
                                        <p class="heading-font-family fs-13 mb-3"><i class="fa fa-square mr-2 mr-0-rtl ml-2-rtl" style="color: #25d7fb"></i> Twitter</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr>
    <div class="widget-list row">
        <div class="widget-holder widget-outside-header col-lg-6 mb-4 mb-lg-0">
            <div class="widget-heading">
                <h5 class="widget-title"><i class="material-icons mr-2">error_outline</i> Activity</h5>
                <div class="widget-actions">
                    <div class="predefinedRanges badge badge-pill bg-success px-3 cursor-pointer heading-font-family" data-plugin-options='{

	                 "locale": {

		                 "format": "MMM YYYY"

	                 }

                 }'><span></span>  <i class="feather feather-chevron-down ml-1"></i>
                    </div>
                </div>
                <!-- /.widget-actions -->
            </div>
            <!-- /.widget-heading -->
            <div class="widget-bg">
                <div class="widget-body pb-0"><a class="btn btn-block color-primary fw-bold fs-12 lh-39 py-0">See all activities ...</a>
                    <hr class="widget-seperator m-0">
                    <div class="widget-user-activities-2 fs-13">
                        <div class="single"><a href="#" class="btn btn-xs btn-rounded btn-pink text-uppercase fw-bold fs-11 px-3 mx-2">Invitation</a>
                            <h5 class="single-title mx-2"><a href="#" class="headings-color">You've been invited to <strong>30s Hikers Meetup</strong></a></h5><small class="headings-font-family text-muted mx-2">today</small>
                        </div>
                        <!-- /.single -->
                        <div class="single"><a href="#" class="btn btn-xs btn-rounded btn-pink text-uppercase fw-bold fs-11 px-3 mx-2">Message</a>
                            <figure class="thumb-xxs mr-b-0 mx-2">
                                <a href="#">
                                    <img src="assets/demo/users/user2.jpg" class="rounded-circle" alt="User 1">
                                </a>
                            </figure>
                            <h5 class="single-title mx-2"><a href="#" class="headings-color"><strong>Steve Smith</strong> sent a message</a></h5><small class="headings-font-family text-muted mx-2">2 days ago</small>
                        </div>
                        <!-- /.single -->
                        <div class="single"><a href="#" class="btn btn-xs btn-rounded btn-teal text-uppercase fw-bold fs-11 px-3 mx-2">To Do</a>
                            <h5 class="single-title mx-2"><a href="#" class="headings-color">Meeting with Nathan on Thursday</a></h5><small class="headings-font-family text-muted mx-2">3 days ago</small>
                        </div>
                        <!-- /.single -->
                        <div class="single"><a href="#" class="btn btn-xs btn-rounded btn-info text-uppercase fw-bold fs-11 px-3 mx-2">Reminder</a>
                            <div class="user-avatar-list">
                                <a href="#" class="thumb-xxs">
                                    <img src="assets/demo/users/user4.jpg" class="rounded-circle" alt="User 4">
                                </a>
                                <a href="#" class="thumb-xxs">
                                    <img src="assets/demo/users/user3.jpg" class="rounded-circle" alt="User 3">
                                </a>
                                <a href="#" class="thumb-xxs">
                                    <img src="assets/demo/users/user2.jpg" class="rounded-circle" alt="User 2">
                                </a>
                            </div>
                            <h5 class="single-title mx-2"><a href="#" class="headings-color"><strong>WordCamp</strong> Meeting, Illinois</a></h5><small class="headings-font-family text-muted mx-2">4 days ago</small>
                        </div>
                        <!-- /.single -->
                        <div class="single"><a href="#" class="btn btn-xs btn-rounded btn-pink text-uppercase fw-bold fs-11 px-3 mx-2">Message</a>
                            <figure class="thumb-xxs mr-b-0 mx-2">
                                <a href="#">
                                    <img src="assets/demo/users/user6.jpg" class="rounded-circle" alt="User 1">
                                </a>
                            </figure>
                            <h5 class="single-title mx-2"><a href="#" class="headings-color"><strong>Marsha Hoffman</strong> sent a message</a></h5><small class="headings-font-family text-muted mx-2">5 days ago</small>
                        </div>
                        <!-- /.single -->
                        <div class="single"><a href="#" class="btn btn-xs btn-rounded btn-success text-uppercase fw-bold fs-11 px-3 mx-2">Files</a>
                            <h5 class="single-title flex-none mx-2">File Uploaded:</h5>
                            <figure class="thumb-xxs mr-b-0 mx-2">
                                <a href="#">
                                    <img src="assets/demo/blog-post-1-thumb.jpg" class="rounded-circle" alt="User 1">
                                </a>
                            </figure>
                            <h5 class="single-title mx-2"><a href="#" class="headings-color"><strong>force.gif</strong> <span class="mx-1 text-muted">(128KB)</span></a></h5><small class="headings-font-family text-muted mx-2">5 days ago</small>
                        </div>
                        <!-- /.single -->
                    </div>
                    <!-- /.widget-user-activities -->
                </div>
                <!-- /.widget-body -->
            </div>
            <!-- /.widget-bg -->
        </div>
        <!-- /.widget-holder -->
        <div class="widget-holder widget-outside-header col-lg-6">
            <div class="widget-heading">
                <h5 class="widget-title"><i class="material-icons mr-2">error_outline</i> Invoices</h5>
                <div class="widget-actions">
                    <div class="predefinedRanges badge badge-pill bg-success px-3 cursor-pointer heading-font-family" data-plugin-options='{

	                 "locale": {

		                 "format": "MMM YYYY"

	                 }

                 }'><span></span>  <i class="feather feather-chevron-down ml-1"></i>
                    </div>
                </div>
                <!-- /.widget-actions -->
            </div>
            <!-- /.widget-heading -->
            <div class="widget-bg">
                <div class="widget-body pb-0">
                    <table class="widget-invoice-table table mb-0 headings-font-family fs-13" valign="center">
                        <thead class="lh-43 fs-12">
                        <tr>
                            <th># Invoice</th>
                            <th class="w-30">Client</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><span class="headings-color"># 250,875</span>
                            </td>
                            <td class="w-25"><span class="headings-color fw-bold">Gene Newman</span>
                            </td>
                            <td><span class="text-muted">15/04/2018</span>
                            </td>
                            <td>
                                <div class="d-flex"><a href="#" class="btn btn-xs px-3 mr-3 fw-900 fs-9 text-uppercase btn-outline-success flex-1 justify-content-center">Paid</a>  <a href="#" class="btn btn-xs px-0 content-color flex-2"><i class="fa fa-chevron-right"></i></a>
                                </div>
                                <!-- /.d-flex -->
                            </td>
                        </tr>
                        <tr>
                            <td><span class="headings-color"># 875,250</span>
                            </td>
                            <td class="w-25"><span class="headings-color fw-bold">Billy Black</span>
                            </td>
                            <td><span class="text-muted">14/04/2018</span>
                            </td>
                            <td>
                                <div class="d-flex"><a href="#" class="btn btn-xs px-3 mr-3 fw-900 fs-9 text-uppercase btn-outline-success flex-1 justify-content-center">Paid</a>  <a href="#" class="btn btn-xs px-0 content-color flex-2"><i class="fa fa-chevron-right"></i></a>
                                </div>
                                <!-- /.d-flex -->
                            </td>
                        </tr>
                        <tr>
                            <td><span class="headings-color"># 520,758</span>
                            </td>
                            <td class="w-25"><span class="headings-color fw-bold">Herbert Diaz</span>
                            </td>
                            <td><span class="text-muted">13/04/2018</span>
                            </td>
                            <td>
                                <div class="d-flex"><a href="#" class="btn btn-xs px-3 mr-3 fw-900 fs-9 text-uppercase btn-outline-danger justify-content-center flex-1">Overdue</a>  <a href="#" class="btn btn-xs px-0 content-color flex-2"><i class="fa fa-chevron-right"></i></a>
                                </div>
                                <!-- /.d-flex -->
                            </td>
                        </tr>
                        <tr>
                            <td><span class="headings-color"># 758,520</span>
                            </td>
                            <td class="w-25"><span class="headings-color fw-bold">Sylvia Harvey</span>
                            </td>
                            <td><span class="text-muted">12/04/2018</span>
                            </td>
                            <td>
                                <div class="d-flex"><a href="#" class="btn btn-xs px-3 mr-3 fw-900 fs-9 text-uppercase btn-outline-success justify-content-center flex-1">Paid</a>  <a href="#" class="btn btn-xs px-0 content-color flex-2"><i class="fa fa-chevron-right"></i></a>
                                </div>
                                <!-- /.d-flex -->
                            </td>
                        </tr>
                        <tr>
                            <td><span class="headings-color"># 250,875</span>
                            </td>
                            <td class="w-25"><span class="headings-color fw-bold">Marsha Hoffman</span>
                            </td>
                            <td><span class="text-muted">11/04/2018</span>
                            </td>
                            <td>
                                <div class="d-flex"><a href="#" class="btn btn-xs px-3 mr-3 fw-900 fs-9 text-uppercase btn-outline-info justify-content-center flex-1">On Hold</a>  <a href="#" class="btn btn-xs px-0 content-color flex-2"><i class="fa fa-chevron-right"></i></a>
                                </div>
                                <!-- /.d-flex -->
                            </td>
                        </tr>
                        <tr>
                            <td><span class="headings-color"># 875,250</span>
                            </td>
                            <td class="w-25"><span class="headings-color fw-bold">Mason Grant</span>
                            </td>
                            <td><span class="text-muted">10/04/2018</span>
                            </td>
                            <td>
                                <div class="d-flex"><a href="#" class="btn btn-xs px-3 mr-3 fw-900 fs-9 text-uppercase btn-outline-info justify-content-center flex-1">On Hold</a>  <a href="#" class="btn btn-xs px-0 content-color flex-2"><i class="fa fa-chevron-right"></i></a>
                                </div>
                                <!-- /.d-flex -->
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.widget-body -->
            </div>
            <!-- /.widget-bg -->
        </div>
        <!-- /.widget-holder -->
    </div>
    <!-- /.widget-list -->

    <hr>
    <div class="widget-list row">
        <div class="widget-holder widget-full-height widget-flex col-lg-6">
            <div class="widget-bg">
                <div class="widget-heading widget-heading-empty-border">
                    <h5 class="widget-title">Latest Posts</h5>
                </div>
                <!-- /.widget-heading -->
                <div class="widget-body">
                    <div class="widget-latest-posts-2">
                        <article class="post post-gallery">
                            <div class="gallery lightbox-gallery row" data-toggle="lightbox-gallery" data-type="image">
                                <div class="col-6">
                                    <a href="assets/demo/carousel/carousel-1.jpg" class="post-img lightbox d-block mr-b-5">
                                        <img src="assets/demo/carousel/carousel-1-thumb.jpg" alt="A book is a dream that you hold in your hands">
                                    </a>
                                </div>
                                <!-- /.col-6 -->
                                <div class="col-6">
                                    <a href="assets/demo/carousel/carousel-2.jpg" class="post-img lightbox d-block mr-b-5">
                                        <img src="assets/demo/carousel/carousel-2-thumb.jpg" alt="A book is a dream that you hold in your hands">
                                    </a>
                                    <a href="assets/demo/carousel/carousel-3.jpg" class="post-img lightbox d-block mr-b-5">
                                        <img src="assets/demo/carousel/carousel-3-thumb.jpg" alt="A book is a dream that you hold in your hands">
                                    </a>
                                </div>
                                <!-- /.col-6 -->
                            </div>
                            <!-- /.gallery -->
                            <div class="post-details">
                                <h4 class="post-title"><a href="">5 Amazing places to visit before you die</a></h4>
                                <p class="headings-font-family">Research shows that there is only half as much variation in student achievement between schools there is among classrooms...</p>
                                <div class="post-links">
                                    <figure>
                                        <a href="#">
                                            <img class="rounded-circle" src="assets/demo/users/user1.jpg" alt="User 1">
                                        </a>
                                    </figure>
                                    <ul>
                                        <li><a href="#"><i class="feather feather-eye"></i> 684</a>
                                        </li>
                                        <li><a href="#"><i class="feather feather-thumbs-up"></i> 53</a>
                                        </li>
                                        <li><a href="#"><i class="feather feather-eye"></i> 21</a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- /.post-links -->
                            </div>
                            <!-- /.post-details -->
                        </article>
                    </div>
                    <!-- /.widget-latest-posts -->
                </div>
                <!-- /.widget-body -->
            </div>
            <!-- /.widget-bg -->
        </div>
        <!-- /.widget-holder -->
        <div class="widget-holder widget-full-height widget-flex col-lg-6">
            <div class="widget-bg">
                <div class="widget-heading widget-heading-border">
                    <h5 class="widget-title">To-Do Widget</h5>
                    <div class="widget-actions"><a href="#" class="btn btn-xs btn-success btn-rounded fw-bold px-3 cursor-pointer heading-font-family text-uppercase">View Calendar</a>
                    </div>
                    <!-- /.widget-actions -->
                </div>
                <!-- /.widget-heading -->
                <div class="widget-body">
                    <div class="widget-todo">
                        <div class="single media"><i class="single-icon feather feather-circle color-color-scheme"></i>
                            <div class="media-body">
                                <div class="text-muted heading-font-family fw-500">09:30 - 10:30</div>
                                <h6 class="single-title">Make an appointment with Doctor</h6>
                                <p class="fw-400 fs-13 mb-0 text-muted"><i class="feather feather-map-pin mr-2"></i> Dr. Schoeb's Spine Center</p>
                            </div>
                            <!-- /.media-body -->
                            <div class="dropdown align-self-center"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="feather feather-more-vertical"></i></a>
                                <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#"><i class="list-icon feather feather-check"></i> Done</a>
                                    <div class="dropdown-divider"></div><a class="dropdown-item" href="#"><i class="list-icon feather feather-delete"></i> Delete</a>
                                </div>
                                <!-- /.dropdown-menu -->
                            </div>
                            <!-- /.dropdown -->
                        </div>
                        <!-- /.single -->
                        <div class="single media"><i class="single-icon feather feather-circle color-info"></i>
                            <div class="media-body">
                                <div class="text-muted heading-font-family fw-500">16:00 - 20:00</div>
                                <h6 class="single-title">Visit WordCamp 2017 Ontario</h6>
                                <p class="fw-400 fs-13 mb-0 text-muted"><i class="feather feather-map-pin mr-2"></i> Carleton University, Ontario</p>
                            </div>
                            <!-- /.media-body -->
                            <div class="user-avatar-list align-self-center mr-3 mr-0-rtl ml-3-rtl"><a href="#" class="btn btn-circle btn-sm btn-white fw-bold more-link">+</a>
                                <a href="#" class="thumb-xxs">
                                    <img src="assets/demo/users/user2.jpg" class="rounded-circle" alt="User 2">
                                </a>
                                <a href="#" class="thumb-xxs">
                                    <img src="assets/demo/users/user3.jpg" class="rounded-circle" alt="User 3">
                                </a>
                                <a href="#" class="thumb-xxs">
                                    <img src="assets/demo/users/user4.jpg" class="rounded-circle" alt="User 4">
                                </a>
                                <a href="#" class="thumb-xxs">
                                    <img src="assets/demo/users/user5.jpg" class="rounded-circle" alt="User 5">
                                </a>
                            </div>
                            <!-- /.user-avatar-list -->
                            <div class="dropdown align-self-center"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="feather feather-more-vertical"></i></a>
                                <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#"><i class="list-icon feather feather-check"></i> Done</a>
                                    <div class="dropdown-divider"></div><a class="dropdown-item" href="#"><i class="list-icon feather feather-delete"></i> Delete</a>
                                </div>
                                <!-- /.dropdown-menu -->
                            </div>
                            <!-- /.dropdown -->
                        </div>
                        <!-- /.single -->
                        <div class="single media"><i class="single-icon feather feather-circle color-success"></i>
                            <div class="media-body">
                                <div class="text-muted heading-font-family fw-500">16:00 - 20:00</div>
                                <h6 class="single-title">Skype call to Herbert Diaz</h6>
                                <ul class="single-tags list-unstyled list-inline">
                                    <li><a href="#">skype</a>
                                    </li>
                                    <li><a href="#">business</a>
                                    </li>
                                    <li><a href="#">call</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- /.media-body -->
                            <div class="user-avatar-list align-self-center mr-3 mr-0-rtl ml-3-rtl">
                                <a href="#" class="thumb-xxs">
                                    <img src="assets/demo/users/user5.jpg" class="rounded-circle" alt="User 2">
                                </a>
                            </div>
                            <!-- /.user-avatar-list -->
                            <div class="dropdown align-self-center"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="feather feather-more-vertical"></i></a>
                                <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#"><i class="list-icon feather feather-check"></i> Done</a>
                                    <div class="dropdown-divider"></div><a class="dropdown-item" href="#"><i class="list-icon feather feather-delete"></i> Delete</a>
                                </div>
                                <!-- /.dropdown-menu -->
                            </div>
                            <!-- /.dropdown -->
                        </div>
                        <!-- /.single -->
                        <div class="single media done"><i class="single-icon feather feather-check-circle color-warning"></i>
                            <div class="media-body">
                                <div class="text-muted heading-font-family fw-500">1 day ago</div>
                                <h6 class="single-title">Visit our boys in Battle Exhibition</h6>
                                <p class="fw-400 fs-13 mb-0 text-muted"><i class="feather feather-map-pin mr-2"></i> St. Mary's Museum, Ontario</p>
                            </div>
                            <!-- /.media-body -->
                            <div class="dropdown align-self-center"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="feather feather-more-vertical"></i></a>
                                <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#"><i class="list-icon feather feather-check"></i> Done</a>
                                    <div class="dropdown-divider"></div><a class="dropdown-item" href="#"><i class="list-icon feather feather-delete"></i> Delete</a>
                                </div>
                                <!-- /.dropdown-menu -->
                            </div>
                            <!-- /.dropdown -->
                        </div>
                        <!-- /.single -->
                        <div class="single media done"><i class="single-icon feather feather-check-circle color-color-scheme"></i>
                            <div class="media-body">
                                <div class="text-muted heading-font-family fw-500">2 day ago</div>
                                <h6 class="single-title">Meeting with WordCamp Speakers</h6>
                                <p class="fw-400 fs-13 mb-0 text-muted"><i class="feather feather-map-pin mr-2"></i> Carleton University, Ontario</p>
                            </div>
                            <!-- /.media-body -->
                            <div class="dropdown align-self-center"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="feather feather-more-vertical"></i></a>
                                <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#"><i class="list-icon feather feather-check"></i> Done</a>
                                    <div class="dropdown-divider"></div><a class="dropdown-item" href="#"><i class="list-icon feather feather-delete"></i> Delete</a>
                                </div>
                                <!-- /.dropdown-menu -->
                            </div>
                            <!-- /.dropdown -->
                        </div>
                        <!-- /.single --> <a href="#" class="add-btn btn btn-circle btn-md fs-20 btn-primary"><i class="feather feather-plus"></i></a>
                    </div>
                    <!-- /.widget-todo -->
                </div>
                <!-- /.widget-body -->
            </div>
            <!-- /.widget-bg -->
        </div>
        <!-- /.widget-holder -->
    </div>
    <!-- /.widget-list -->
@endsection
