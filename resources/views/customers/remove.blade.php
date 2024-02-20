@extends('layouts.sistema')
@section('content')
    <div class="row page-title clearfix">
        <div class="page-title-left">
            <h6 class="page-title-heading mr-0 mr-r-5">Excluir cliente</h6>
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

    <div class="widget-list">
        <div class="row">
            <div class="content-with-sidebar">
               <div class="bg-white p-3 border-radius-3">
                   <div class="widget-body">
                       <div class="col-md-12 content">
                           @if (session('success'))
                               <div class="alert alert-success">
                                   <i class="icone-ok-3"></i>
                                   {{ session('success') }}
                               </div>
                           @endif

                           @if (session('error'))
                               <div class="alert alert-danger">
                                   <i class="icone-attention"></i>
                                   {{ session('error') }}
                               </div>
                           @endif
                           {{--<header class="header-content">--}}
                               {{--<h1 class="title-2">--}}
                               {{--@if($customer->type == "fisica")--}}
                                   <!--<i class="icone-user-1"></i>-->
                               {{--@else--}}
                                   <!-- <i class="icone-building"></i>-->
                                   {{--@endif--}}

                                   {{--Excluir cliente--}}
                               {{--</h1>--}}


                           {{--</header>--}}

                           <div class="box-info profile">
                               <div class=" profile-user-description p-3 box-info-grid ">
                                    <header>


                                   <div class="col-md-12 text-center">
                                       <h2 class="color-red excluir">{{ $customer->name }}</h2>
                                       <span class="legenda color-red">ESTA OPERAÇÃO É IRREVERSÍVEL</span>
                                   </div>
                               </header>
                               </div>
                               <h6 class="mr-b-20 mr-t-0 mr-t-20">
                                   <i class="icone-attention"></i>
                                   Você tem certeza de que deseja fazer isto?
                               </h6>
                               <div class="widget-body profile-user-description p-3 box-info-grid mr-t-20">

                                   <div class="col-md-12">
                                           <div class="row">
                                               <div class="col-md-12">
                                                   <ul class="excluir">
                                                       <li>O <b>Histórico Financeiro</b> deste cliente será removido;</li>
                                                       <li>Todas as <b>Assinaturas</b> deste cliente serão suspensas e removidas;</li>
                                                       <li>Todos os <b>Tickets de Suporte</b> deste cliente serão arquivados;</li>
                                                       <li>Qualquer cobrança enviada ao cliente a partir da presente data, será desconsiderada;</li>
                                                   </ul>
                                               </div>
                                           </div>
                                       </div>

                               </div>
                           </div>
                           <form action="{{ route('customers.submit.del') }}" method="post" id="formDel_cliente">
                               <h6 class="mr-b-20 mr-t-0 mr-t-20">
                                   <i class="icone-attention"></i>
                                   Para continuar a exclusão, aceite o termo abaixo:
                               </h6>
                               <div class="widget-body profile-user-description p-3 box-info-grid mr-tb-20">



                                       <div class="checkbox">
                                           <label>Removendo este cliente do painel de controle, eu estou ciente que todos os dados referentes ao cliente serão apagados e não será retida nenhuma cópia de backup. Todo e qualquer eventual backup existente será removido na exclusão deste cliente, seja de cobranças, assinaturas ou tickets de suporte</label>
                                       </div>
                                       <div class="form-check pd-l-20">
                                           <input required type="checkbox" class="form-check-input" id="aceita_termos" title="This field should not be left blank." oninvalid="this.setCustomValidity('Aceite os termos antes de excluir o cliente.')" onchange="this.setCustomValidity('')"/>
                                           <label class="" for=""><b>Aceito os termos</b></label>
                                       </div>

                                       <input type="hidden" name="uuid" value="{{ $customer->uuid }}">
                                       {{ csrf_field() }}
                               </div>
                                   <center>
                                       <button type="submit" class="btn btn-danger" style="margin: 10px 0;">
                                           <b>QUERO EXCLUIR ESTE CLIENTE</b>
                                       </button>
                                   </center>
                           </form>

                       </div>
                   </div>
               </div>

            </div>
            <div class="actions-sidebar">
                <div class="widget-bg widget-notes  border-radius-3">
                    <div class="widget-body profile-user-description p-3">
                        <h6 class="mr-t-0">
                            <i class="icone-info-circled-1"></i>
                            Outra coisa AQUI
                        </h6>

                        <div class="contact-details-cell text-left">
                            <p class="mr-b-0 w-100">
                               ALGO ALGO ALGO ALGO
                            </p>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>
@endsection