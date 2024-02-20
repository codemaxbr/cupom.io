@extends('layouts.sistema')
@section('content')

    <!-- Page Title Area -->
    <div class="row page-title clearfix">
        <div class="page-title-left">
            <h6 class="page-title-heading mr-0 mr-r-5">Detalhes da Assinatura</h6>
            <p class="page-title-description mr-0 d-none d-md-inline-block">#{{ $assinatura->id }}</p>
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
                <li class="breadcrumb-item active">#{{ $assinatura->id }}</li>
            </ol>
        </div>
    </div>

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

    <!-- =================================== -->
    <!-- Different data widgets ============ -->
    <!-- =================================== -->
    <div class="widget-list">
        <div class="row">

            <!-- Tabs Content -->
            <div class="content-with-sidebar">

                <div class="tabs tabs-bordered">
                    <ul class="nav nav-tabs">
                        <li class="nav-item" aria-expanded="false">
                            <a class="nav-link active" href="#resumo" data-toggle="tab" aria-expanded="true">Resumo Geral</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#atividades" data-toggle="tab" aria-expanded="false">Histórico de Atividades</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#emails" data-toggle="tab" aria-expanded="false">E-mails</a>
                        </li>
                    </ul>

                    <div class="tab-content bg-none p-0">
                        <div class="tab-pane active" id="resumo" aria-expanded="true">

                            <div class="detalhes mr-t-20 bg-white p-3 border-radius-3">
                                <h6 class="mr-b-10 mr-t-0 fs-22">
                                    <i class="fa fa-globe mr-r-5"></i>
                                    @if($assinatura->domain != NULL)
                                        {{ $assinatura->domain }}
                                    @else
                                        Info
                                    @endif

                                    @switch($assinatura->status)
                                        @case(0)
                                        <span class="badge badge-danger f-right">
                                            <i class="icone-attention-circled"></i>
                                            Suspenso
                                        </span>
                                        @break

                                        @case(1)
                                        <span class="badge badge-success f-right fs-15">
                                            <i class="icone-ok-3"></i>
                                            Ativa
                                        </span>
                                        @break

                                        @case(2)
                                        <span class="badge badge-dribbble f-right fs-15">
                                            <i class="icone-gift"></i>
                                            Cortesia
                                        </span>
                                        @break
                                    @endswitch
                                </h6>


                                <div class="box-info-grid">

                                    <div class="row detalhes">
                                        <div class="col-md-12">

                                            <div class="row fs-15">
                                                <div class="col-md-5 text-right"></div>
                                                <div class="col-md-7 no-padding-left">
                                                    @if($assinatura->plan->module != null)
                                                        <img src="{{ asset('images/modules/panel/'.$assinatura->plan->module->logo) }}" class="mr-b-10" style="max-height: 40px;" alt="">
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="row fs-15">
                                                <div class="col-md-5 text-right">
                                                    <b>Ações</b>
                                                </div>
                                                <div class="col-md-7 no-padding-left">

                                                    <a href="#" class="btn btn-primary btn-xs fs-14">
                                                        <i class="icone-popup-3"></i>
                                                        Painel de assinante
                                                    </a>

                                                    @if($assinatura->status == 0)
                                                        <a class="btn btn-default btn-xs fs-15" data-toggle="modal" data-target="#reativarAssinatura">
                                                            <i class="icone-sun-filled"></i>
                                                            Reativar
                                                        </a>
                                                    @endif

                                                    @if($assinatura->status != 0)
                                                        <a class="btn btn-default btn-xs fs-15" data-id="{{ $assinatura->id }}" data-toggle="modal" data-target="#suspenderAssinatura">
                                                            <i class="icone-moon-inv"></i>
                                                            Suspender
                                                        </a>
                                                    @endif
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
                                                    #{{ $assinatura->id }}
                                                </div>
                                            </div>

                                            <div class="row bg-white p-1">
                                                <div class="col-md-5 text-right">
                                                    <b>Plano contratado:</b>
                                                </div>
                                                <div class="col-md-6 no-padding-left">
                                                    {{ $assinatura->plan->name }}
                                                    <a class="btn btn-default btn-xs fs-13 mr-l-5" data-toggle="modal" data-target="#updatePlan">
                                                        Alterar plano
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="row bg-white p-1">
                                                <div class="col-md-5 text-right">
                                                    <b>Valor:</b>
                                                </div>
                                                <div class="col-md-6 no-padding-left">
                                                    R$ {{ numFormat($assinatura->total) }}
                                                </div>
                                            </div>

                                            <div class="row bg-white p-1">
                                                <div class="col-md-5 text-right">
                                                    <b>Ciclo:</b>
                                                </div>
                                                <div class="col-md-6 no-padding-left">
                                                    {{ $assinatura->plan->payment_cycle->name }}
                                                </div>
                                            </div>

                                            <div class="row bg-white p-1">
                                                <div class="col-md-5 text-right">
                                                    <b>Data de Ativação:</b>
                                                </div>
                                                <div class="col-md-6 no-padding-left">
                                                    <i class="icone-calendar"></i>
                                                    {{ $assinatura->activated_at->format('d/m/Y H:i') }}
                                                </div>
                                            </div>

                                            <div class="row bg-white p-1">
                                                <div class="col-md-5 text-right">
                                                    <b>Vencimento:</b>
                                                </div>
                                                <div class="col-md-7 no-padding-left">
                                                    <i class="icone-calendar"></i>
                                                    {{ $assinatura->due->format('d/m/Y') }}
                                                    <a href="" class="btn btn-default btn-xs fs-13 mr-l-5" data-toggle="modal" data-target="#updateDue">
                                                        Alterar
                                                    </a>


                                                </div>
                                            </div>

                                            <div class="row bg-white p-1">
                                                <div class="col-md-5 text-right">
                                                    <b>Cliente:</b>
                                                </div>
                                                <div class="col-md-7 no-padding-left">
                                                    {{ $assinatura->customer->name }}
                                                    <a href="{{ route('customers.view', $assinatura->customer->uuid) }}">(#{{ $assinatura->customer->id }})</a><br />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <!-- Serviços adicionais @todo Continuar depois, esqueci o caderno em casa -->
                            <div class="adicionais mr-t-20 bg-white p-3 border-radius-3">
                                <h6 class="mr-b-10 mr-t-0">
                                    Serviços adicionais
                                </h6>
                                Nenhum serviço contratado
                            </div>
                            <!-- Fim Serviços adicionais -->

                            <!-- Faturas -->
                            <div class="faturas mr-t-20 bg-white p-3 border-radius-3">
                                <h6 class="mr-b-10 mr-t-0">
                                    Faturas

                                    @if($assinatura->invoices->isNotEmpty())
                                        <div class="btn-group btn-group-xs f-right ">
                                            <div class="dropdown">
                                                <button aria-expanded="false" data-toggle="dropdown" class="btn btn-xs btn-default dropdown-toggle fs-13" type="button">
                                                    Ações <span class="caret"></span>
                                                </button>

                                                <div role="menu" class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="#">
                                                        Enviar lembrete
                                                    </a>

                                                    <a class="dropdown-item" href="#">
                                                        Alterar data de vencimento
                                                    </a>

                                                    <a class="dropdown-item" href="#" title="Dar baixa">
                                                        Marcar como Pago
                                                    </a>

                                                    <a class="dropdown-item" href="#">
                                                        Marcar como Nula
                                                    </a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item" href="#">
                                                        Excluir
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                </h6>
                                @if($assinatura->invoices->isNotEmpty())

                                    <table class="table table-hover mr-t-20 mb-0">
                                        <thead>
                                        <tr class="thead-inverse bg-dark-contrast">
                                            <th class="txt-center" style="width: 15px;">
                                                <input type="checkbox" class="selecionaTodos">
                                            </th>
                                            <th>Vencimento</th>
                                            <th>Tipo</th>
                                            <th>ID de Referência</th>
                                            <th>Valor</th>
                                            <th class="text-right">Situação</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($assinatura->invoices as $invoice)
                                            <tr class="text-dark">
                                                <td>
                                                    <input name="uuid" class="td_item" value="" nome="" type="checkbox">
                                                </td>
                                                <td>{{ $invoice->due->format('d/m/Y') }}</td>
                                                <td>
                                                    @switch($invoice->type)
                                                        @case('recorrencia') Recorrência @break
                                                        @case('pedido') Pedido @break
                                                        @case('avulsa') Avulsa @break
                                                    @endswitch
                                                </td>
                                                <td><a href="#">#{{ $invoice->id }}</a></td>
                                                <td>R$ {{ numFormat($invoice->total) }}</td>
                                                <td class="text-right">
                                                    @switch($invoice->status)
                                                        @case(0) <span class="badge badge-orange fs-13 py-1 px-2">Pendente</span> @break
                                                        @case(1) <span class="badge badge-success fs-13 py-1 px-2">Pago</span> @break
                                                        @case(2) <span class="badge badge-red fs-13 py-1 px-2">Não pago</span> @break
                                                    @endswitch
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    Nenhuma fatura foi gerada para esta assinatura.
                                @endif
                            </div>
                            <!-- / Faturas -->

                        </div>
                    </div>
                    <!--./tab-content -->
                </div>

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

                        <a href="#">{{ $assinatura->customer->name }}</a><br />
                        {{ $assinatura->customer->email }}

                        <div class="contact-details-cell text-left mr-t-10">
                            <p class="mr-b-0 w-100">
                                <small class="heading-font-family fw-500">Endereço de Cobrança</small><br />
                                @if($assinatura->customer->address != null)
                                    {{ $assinatura->customer->address->address.", ".$assinatura->customer->address->number }}<br />
                                    {{ $assinatura->customer->address->additional." - ".$assinatura->customer->address->district }}<br />
                                    {{ $assinatura->customer->address->city.", ".$assinatura->customer->address->uf." - ".$assinatura->customer->address->zipcode }}<br />
                                    Brasil<br />

                                    <a href="#" class="fs-13 d-block text-center">
                                        <i class="fa fa-map-marker"></i>
                                        <b>Ver no mapa</b>
                                    </a>
                                @else
                                    Sem dados de endereço
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
                <!-- ./ Endereços -->

                <!-- Cartões -->
                <div class="widget-bg widget-notes mr-t-20 border-radius-3">
                    <div class="widget-body profile-user-description p-3">
                        <h6 class="mr-t-0">
                            <i class="fa fa-dollar mr-r-5 fs-16"></i>
                            Forma de pagamento
                        </h6>

                        <div class="contact-details-cell text-left">
                            <p class="mr-b-0 w-100">
                                @if($assinatura->type_payment_id != 0)
                                    <small class="heading-font-family fw-500">
                                        @switch($assinatura->type_payment_id)
                                            @case(1) <i class="icone-barcode-1 text-dark"></i> @break
                                            @case(2) <i class="icone-credit-card text-dark"></i> @break
                                            @case(3) <i class="icone-bank text-dark"></i>@break
                                            @case(5) <i class="icone-bank text-dark"></i>@break
                                            @case(4) <i class="icone-money text-dark"></i> @break
                                            @case(6) <i class="icone-paypal-2 text-dark"></i> @break
                                        @endswitch
                                        {{ $assinatura->type_payment->name }}
                                    </small><br />
                                    Próxima cobrança em <b>{{ $assinatura->due->format('d/m/Y') }}</b>
                                @else
                                    Não faturável
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
                <!-- ./ Cartões -->

                <!-- Cancelar assinatura -->
                <div class="widget-bg widget-notes mr-t-20 border-radius-3">
                    <div class="widget-body profile-user-description p-3">
                        <h6 class="mr-t-0 text-red">
                            <i class="icone-power fs-16"></i>
                            Cancelar assinatura
                        </h6>

                        <div class="contact-details-cell text-left">
                            <p class="mr-b-0 w-100">
                                <small class="heading-font-family fw-500">
                                    Cancelar na renovação seguinte
                                </small><br />

                                O cliente pode utilizar o serviço até ao final do período atual e a assinatura será cancelada em <b>{{ $assinatura->due->format('d/m/Y') }}</b>

                                <a class="btn btn-primary btn-xs fs-14" data-toggle="modal" data-target="#cancelReason">
                                    Cancelar na renovação seguinte
                                </a>
                            </p>
                        </div>

                        <div class="contact-details-cell text-left">
                            <p class="mr-b-0 w-100">
                                <small class="heading-font-family fw-500">
                                    Cancelar imediatamente
                                </small><br />

                                A assinatura será imediatamente cancelada e o cliente não conseguirá utilizar o serviço desde o momento em que é cancelada.

                                <a class="btn btn-primary btn-xs fs-14" data-toggle="modal" data-target="#cancelReasonImmediate">
                                    Cancelar imediatamente
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
                <!-- ./ Cancelar assinatura -->

            </div>

        </div>
    </div>

    <!-- Modal suspender OK -->
    <div class="modal modal-primary fade modal-suspender" id="suspenderAssinatura" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel2" aria-hidden="true" style="">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <form action="{{ route('subscriptions.updatePlan', $assinatura->id) }}" method="post">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="status" value="0" />

                    <div class="modal-header text-inverse">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h5 class="modal-title" id="mySmallModalLabel2">Suspender assinatura</h5>
                    </div>
                    <div class="modal-body text-center">
                        <div class="text-dark">
                            <i class="icone-attention text-danger fs-26"></i><br />
                            Tem certeza que deseja <b class="text-danger">SUSPENDER</b> esta assinatura?
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-xs fs-14">
                            Confirmar
                        </button>

                        <button type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-default btn-xs fs-14">
                            Cancelar
                        </button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <!-- Modal reativar OK -->
    <div class="modal modal-primary fade modal-reativar" id="reativarAssinatura" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel2" aria-hidden="true" style="">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <form action="{{ route('subscriptions.updatePlan', $assinatura->id) }}" method="post">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="status" value="1" />

                    <div class="modal-header text-inverse">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h5 class="modal-title" id="mySmallModalLabel2">Reativar assinatura</h5>
                    </div>
                    <div class="modal-body text-center">
                        <div class="text-dark">
                            <i class="icone-ok text-success fs-26"></i><br />
                            Tem certeza que deseja <b class="text-dark">REATIVAR</b> esta assinatura?
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-xs fs-14">
                            Confirmar
                        </button>

                        <button type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-default btn-xs fs-14">
                            Cancelar
                        </button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <!-- Modal Cancelar assinatura -->
    <div class="modal fade modal-primary bs-modal-md" id="cancelReason" tabindex="-1" role="dialog" >
        <div class="modal-dialog">
            <div class="modal-content" style="width: 600px;">
                <form method="post" action="{{route('subscriptions.cancelSubscription', $assinatura->id)}}">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h5 class="modal-title text-white" id="canceReason">Cancelamento de Assinatura</h5>
                    </div>

                    <div class="modal-body">
                        <div class="alert alert-warning">
                            Esta assinatura será completamente encerrada no próximo vencimento.
                        </div>
                        @method('PUT')
                        @csrf

                        <div class="form-group">
                            <label for="cancellations_reason" style="display: block;">
                                Motivo do Cancelamento
                            </label>
                            <textarea class="form-control" id="cancellations_reason" name="reason" rows="3"></textarea>
                            <input type="hidden" id="cancellations_customer_id" name="customer_id" value="{{$assinatura->customer->id}}">
                            <input type="hidden" id="cancellations_plan_id" name="plan_id" value="{{$assinatura->plan->id}}">
                            <input type="hidden" id="cancellations_total" name="total" value="{{numFormat($assinatura->total)}}">
                            <input type="hidden" id="cancellations_activated_at" name="activated_at" value="{{$assinatura->activated_at}}">
                            <input type="hidden" id="cancellations_user_id" name="cancellations_user_id" value="{{$assinatura->login_user}}">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit"  class="btn btn-primary btn-xs fs-14">
                            <i class="icone-cancel-circled-1"></i>
                            Cancelar Assinatura
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Suspender Imediatamente -->
    <div class="modal fade modal-primary bs-modal-md" id="cancelReasonImmediate" tabindex="-1" role="dialog" >
        <div class="modal-dialog">
            <div class="modal-content" style="width: 600px;">
                <form class="form-control" method="post" action="{{route('subscriptions.cancelSubscriptionImmediate', $assinatura->id)}}">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h5 class="modal-title text-white" id="canceReason">Cancelamento de Assinatura</h5>
                    </div>

                    <div class="modal-body">
                        <div class="alert alert-warning">
                            Esta assinatura será completamente encerrada neste exato momento.
                        </div>
                        @method('PUT')
                        @csrf

                        <div class="form-group">
                            <label for="cancellations_reason" style="display: block;">
                                Motivo do Cancelamento
                            </label>
                            <textarea class="form-control" id="cancellations_reason" name="reason" rows="3"></textarea>
                            <input type="hidden" id="cancellations_customer_id" name="customer_id" value="{{$assinatura->customer->id}}">
                            <input type="hidden" id="cancellations_plan_id" name="plan_id" value="{{$assinatura->plan->id}}">
                            <input type="hidden" id="cancellations_total" name="total" value="{{numFormat($assinatura->total)}}">
                            <input type="hidden" id="cancellations_activated_at" name="activated_at" value="{{$assinatura->activated_at}}">
                            <input type="hidden" id="cancellations_user_id" name="cancellations_user_id" value="{{$assinatura->login_user}}">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit"  class="btn btn-primary btn-xs fs-14">
                            <i class="icone-cancel-circled-1"></i>
                            Cancelar Assinatura
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal trocar plano OK -->
    <div class="modal fade modal-primary bs-modal-sm" id="updatePlan" tabindex="-1" role="dialog" >
        <div class="modal-dialog modal-sm">
            <div class="modal-content" style="width: 400px;">
                <form method="post" action="{{route('subscriptions.updatePlan', $assinatura->id)}}">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h5 class="modal-title text-white" id="canceReason">Alterar plano</h5>
                    </div>

                    <div class="modal-body">
                        @method('PUT')
                        @csrf

                        <div class="form-group">
                            <label for="plan_id">Selecione o novo plano</label>
                            <select class="form-control selectpicker" name="plan_id" id="plan_id">
                                @foreach($plans as $plan)
                                    <option value="{{$plan->id}}" @if($assinatura->plan_id == $plan->id) selected="selected" @endif>{{$plan->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-xs fs-14">
                            Confirmar
                        </button>

                        <button type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-default btn-xs fs-14">
                            Cancelar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal --- -->
    <div class="modal fade modal-primary bs-modal-md" id="sasa" tabindex="-1" role="dialog" >
        <div class="modal-dialog">
            <div class="modal-content" style="width: 600px;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h5 class="modal-title text-white" id="canceReason">Selecione o novo vencimento</h5>
                </div>
                <div class="modal-body">
                    <form class="form-control" method="post" action="{{route('subscriptions.updatePlan', $assinatura->id)}}">
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">

                                </div>
                                <div class="form-group">
                                    <label for="due">Vencimento</label>
                                    <input class="form-control datepicker" value="{{$assinatura->due}}">

                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit"  class="btn btn-primary btn-sm fs-14">Alterar plano</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal alterar vencimento OK -->
    <div class="modal modal-primary fade modal-alterar-vencimento" id="updateDue" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel2" aria-hidden="true" style="display: none">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <form action="{{ route('subscriptions.updateDue', $assinatura->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="modal-header text-inverse">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h5 class="modal-title" id="mySmallModalLabel2">Alterar vencimento</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group input-has-value">
                            <label class="form-control-label">Selecione uma data de vencimento</label>
                            <div class="input-group input-has-value">
                                <input type="text" name="due" class="form-control datepicker2" value="{{ $assinatura->due->format('d/m/Y') }}">
                                <span class="input-group-addon">
                            <i class="icone-calendar"></i>
                        </span>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-xs fs-14">
                            Aplicar
                        </button>

                        <button type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-default btn-xs fs-14">
                            Cancelar
                        </button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>


    <!--
    @todo Criar modal para Cancelamento
    @todo Criar modal para Alterar o plano
    @todo Criar modal para Alterar o vencimento
    @todo Criar modal para função Suspender
    -->

    <!--
    @todo Criar modal para Cancelamento
    @todo Criar modal para Alterar o plano
    @todo Criar modal para Alterar o vencimento
    @todo Criar modal para função Suspender
    -->

    <script type="text/javascript">
        $(function () {

            $('[rel="suspenderAssinatura"]').on('click', function () {
                var id_assinatura = $(this).data('id');
                $('#suspenderAssinatura').modal("show");
            });

            $('.datepicker2').datepicker({
                format: 'dd/mm/yyyy',
                startDate: '0d',
                startView: '0',
                todayHighlight: true,
            });
        });
    </script>

@endsection