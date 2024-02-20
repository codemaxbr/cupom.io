@extends('layouts.sistema')
@section('content')

    <!-- Page Title Area -->
    <div class="row page-title clearfix">
        <div class="page-title-left">
            <h6 class="page-title-heading mr-0 mr-r-5">{{ $customer->name }}</h6>
            <p class="page-title-description mr-0 d-none d-md-inline-block">#{{ $customer->id }}</p>
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
                <li class="breadcrumb-item active">#{{ $customer->id }}</li>
            </ol>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            <i class="icone-ok-3"></i>
            {{ session('success') }}
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
                        <li class="nav-item">
                            <a class="nav-link" href="#faturas" data-toggle="tab" aria-expanded="false">Faturas</a>
                        </li>
                    </ul>

                    <div class="tab-content bg-none p-0">
                        <div class="tab-pane active" id="resumo" aria-expanded="true">

                            <div class="detalhes mr-t-20 bg-white p-3 border-radius-3">
                                <h6 class="mr-b-10 mr-t-0">
                                    <i class="fa fa-vcard mr-r-5"></i>
                                    Detalhes do Cadastro

                                    <span class="badge badge-secondary f-right">Não confirmado</span>
                                </h6>

                                <div class="row columns-border-bw resume-financial">
                                    <div class="col-3 d-flex flex-column justify-content-center align-items-center py-4">
                                        <h4 class="my-0">
                                            R$
                                            <span class="counter" id="counter-0">0,00</span>
                                        </h4>
                                        <small>Saldo</small>
                                    </div>
                                    <!-- /.col-4 -->
                                    <div class="col-3 d-flex flex-column justify-content-center align-items-center py-4">
                                        <h4 class="my-0">
                                            R$ {{numFormat($totalInvoices)}}
                                        </h4>
                                        <small>Dentro do prazo</small>
                                    </div>
                                    <!-- /.col-4 -->
                                    <div class="col-3 d-flex flex-column justify-content-center align-items-center py-4">
                                        <h4 class="my-0 text-red">
                                            R$ {{numFormat($totalVencidas)}}

                                        </h4>
                                        <small>Vencido</small>
                                    </div>
                                    <!-- /.col-4 -->

                                    <div class="col-3 d-flex flex-column justify-content-center align-items-center py-4">
                                        <h4 class="my-0">
                                            <span class="counter" id="counter-2">0</span> dias
                                        </h4>
                                        <small>Média de pagamento</small>
                                    </div>
                                    <!-- /.col-4 -->
                                </div>
                                <div class="box-info-grid">
                                    <div class="row detalhes">
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <b>Nome:</b>
                                                </div>
                                                <div class="col-md-8 no-padding-left">
                                                    {{ $customer->name }}
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <b>CPF:</b>
                                                </div>
                                                <div class="col-md-8 no-padding-left">
                                                    {{ $customer->cpf_cnpj }}
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <b>Cliente desde:</b>
                                                </div>
                                                <div class="col-md-8 no-padding-left">
                                                    {{ $customer->created_at->format('d/m/Y') }}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <b>E-mail:</b>
                                                </div>
                                                <div class="col-md-8 no-padding-left">
                                                    {{ $customer->email }}
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <b>Telefone:</b>
                                                </div>
                                                <div class="col-md-8 no-padding-left">
                                                    {{ $customer->phone }}
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <b>Último login:</b>
                                                </div>
                                                <div class="col-md-8 no-padding-left">
                                                    Ontem
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Assinaturas -->
                            <div class="servicos_contratados mr-t-20  bg-white p-3 border-radius-3">
                                <h6 class="mr-b-20 mr-t-0">
                                    <i class="fa fa-shopping-cart mr-r-5"></i>
                                    Assinaturas

                                    <a href="#" class="f-right fs-15 mr-r-5">
                                        <i class="fa fa-calendar mr-r-5 mr-t-5"></i>
                                        Histórico de Assinaturas
                                    </a>
                                </h6>

                                @forelse($customer->subscriptions as $subscription)
                                <div class="ls-subscription m-1 mr-b-10">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="ls-description">
                                                <a href="{{route('config.plans.edit', $subscription->plan->id)}}" class="fs-15">{{$subscription->plan->name}}</a>
                                                <small>{{$subscription->plan->description}}</small>

                                                <div class="form-group">
                                                    <label class="label">ID da assinatura:</label>
                                                    {{$subscription->id}}
                                                </div>
                                            </div>

                                            <div class="ls-dates">
                                                <div class="form-group d-inline-block">
                                                    <label class="label">Data de ativação:</label>
                                                    {{$subscription->activated_at->format('d/m/Y')}}
                                                </div>

                                                <div class="form-group d-inline-block">
                                                    <label class="label">Próximo Vencimento:</label>
                                                    {{$subscription->due->format('d/m/Y')}}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-3 text-right">
                                            <div class="ls-price">
                                                {{numFormat($subscription->plan->price)}} /mês
                                            </div>
                                            @if($subscription->status == 1)
                                                <div class="color-green text-uppercase fs-12">
                                                    <i class="fa fa-circle fs-9"></i>
                                                    Ativo
                                                </div>
                                                @else
                                                    <div class="color-red text-uppercase fs-12">
                                                        <i class="fa fa-circle fs-9"></i>
                                                        Inativo
                                                    </div>

                                            @endif


                                            <div class="ls-actions">
                                                <div class="btn-group">
                                                    <div class="dropdown">
                                                        <button aria-expanded="false" data-toggle="dropdown" class="btn btn-xs btn-primary dropdown-toggle fs-14" type="button">
                                                            Ações <span class="caret"></span>
                                                        </button>

                                                        <div role="menu" class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item" href="#">
                                                                Action
                                                            </a>

                                                            <a class="dropdown-item" href="#">
                                                                Another action
                                                            </a>

                                                            <a class="dropdown-item" href="#">
                                                                Something else here
                                                            </a>
                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item" href="#">
                                                                Separated link
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <div class="no-subs">
                                    <div class="no-row-msg">
                                        <svg class="empty" id="Layer_1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <path fill="#999" d="M454 135.9l-.1-3.9H377v-19.1c0-2.2-1.8-3.9-4.1-3.9h-25.3c-2.2 0-3.7 1.7-3.7 3.9V132H197v-19.1c0-2.2-1.8-3.9-4.1-3.9h-25.3c-2.2 0-3.7 1.7-3.7 3.9V132H95v1h-.6l.1 4.2c.3 4.6.5 9.2.5 13.8v40.7c0 27.5-3.6 55-8.4 82-6 33.9-15 67.5-27 99.9l-2.2 5.3 37.5.4v24.2l357.6-.5.2-3.9c1.1-39.9 1.8-80.2 2.1-120.1.4-47.5.1-95.6-.8-143.1zM189 117v30.7c0 3.2-2.7 6.3-5.9 6.3h-5.6c-3.2 0-5.5-3.1-5.5-6.3V117h17zm180 0v30.7c0 3.2-2.7 6.3-5.9 6.3h-5.6c-3.2 0-5.5-3.1-5.5-6.3V117h17zm-265.8 24l60.8.2v6.5c0 7.6 5.9 14.3 13.5 14.3h5.6c7.6 0 13.9-6.7 13.9-14.3v-6.4l147 .4v6c0 7.6 5.9 14.3 13.5 14.3h5.6c7.6 0 13.9-6.7 13.9-14.3v-5.9l66.1.2c.3 46.1-3.4 92.5-11.1 137.8-5.4 32-12.9 64-22.3 95.2l-340.5-4c11.2-31.2 19.8-63.4 25.6-95.9 7.9-44.1 10.7-89.2 8.4-134.1zM447 279c-.2 38.5-1.1 77.5-2.1 116l-341.9.5v-16.1l312.3 3.6 1-2.9c9.9-32.4 17.8-65.7 23.4-99 3-17.8 5.5-35.8 7.3-53.8.1 17.3.1 34.5 0 51.7z"></path>
                                            <circle fill="#999" cx="217.4" cy="229" r="13.9"></circle>
                                            <circle fill="#999" cx="309.1" cy="229" r="13.9"></circle>
                                            <path fill="#999" d="M192 326.5c.8 0 1.7-.3 2.4-.8 13.9-10.6 30.2-18.1 47.2-21.8 24.1-5.1 44.9-1.6 58 2.3 2.1.6 4.3-.6 5-2.7.6-2.1-.6-4.3-2.7-5-14-4.2-36.2-7.9-62-2.5-18.1 3.9-35.6 11.9-50.4 23.2-1.8 1.3-2.1 3.9-.7 5.6.8 1.2 2 1.7 3.2 1.7z"></path>
                                        </svg>

                                        <span>Este cliente não possui assinatura ativa!</span>
                                        <a href="#/subscriptions/new?customer_id=1416044000000065125" class="btn btn-primary btn-sm fs-14">Criar um pedido</a>
                                    </div>
                                </div>
                                @endforelse

                            </div>
                            <!-- ./ Assinaturas -->

                            <!-- Histórico Financeiro -->
                            <div class="historico_financeiro mr-t-20 bg-white p-3 border-radius-3">
                                <!-- Histórico Financeiro -->
                                <h6 class="mr-b-20 mr-t-0">
                                    <i class="fa fa-calendar"></i>
                                    Histórico financeiro
                                    <small class="d-block mt-1 fs-15" style="color: #999">
                                        Escolha um mês e clique em <i class="color-dark">Ver mês</i> para visualizar o histórico do mês correspondente
                                    </small>
                                </h6>

                                <div class="contact-details-cell" style="background: #f6f6f6; padding: 10px 20px;">
                                    <div class="input-group input-group-sm w-50">
                                        <select name="mes" id="" class="form-control fs-14">
                                            <option value="1">Janeiro / 2018</option>
                                            <option value="2">Fevereiro / 2018</option>
                                            <option value="3">Março / 2018</option>
                                            <option value="4">Abril / 2018</option>
                                            <option value="5">Maio / 2018</option>
                                            <option value="6">Junho / 2018</option>
                                            <option value="7">Julho / 2018</option>
                                            <option value="8">Agosto / 2018</option>
                                            <option value="9">Setembro / 2018</option>
                                            <option value="10">Outubro / 2018</option>
                                            <option value="11">Novembro / 2018</option>
                                            <option value="12">Dezembro / 2018</option>
                                        </select>
                                        <span class="input-group-btn">
                                            <a class="btn btn-dark fs-14" style="height: 36px;" href="javascript: void(0);">Ver mês</a>
                                        </span>
                                    </div>

                                    <h4 class="text-right w-50 fw-600">Janeiro/2018</h4>
                                </div>

                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>Data</th>
                                        <th>Descrição</th>
                                        <th></th>
                                        <th></th>
                                        <th class="text-right" style="width: 70px;">Valor R$</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($customer->statements as $lancamento)
                                        <tr class="color-dark">
                                            <td>{{$lancamento->created_at->format('d/m/Y')}}</td>
                                            <td>{{$lancamento->name}}</td>
                                            <td></td>
                                            <td>@if($lancamento->type == 'credito') +

                                                @else
                                                    -
                                                @endif</td>
                                            <td class="text-right">{{numFormat($lancamento->total)}}</td>
                                        </tr>
                                     @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Nenhuma transação encontrada</td>
                                        </tr>
                                     @endforelse
                                    </tbody>
                                </table>
                                <!-- /. Histórico Financeiro -->
                            </div>
                            <!-- / Historico Financeiro -->

                        </div>

                        <div class="tab-pane" id="atividades" aria-expanded="true">
                            <!-- Faturas -->
                            <div class="activities mr-t-20 bg-white p-3 border-radius-3">
                                <h6 class="mr-b-20 mr-t-0">
                                    <i class="fa fa-calendar mr-r-5"></i>
                                    Últimas atividades

                                    <a href="#" class="f-right fs-15 mr-r-5">
                                        <i class="fa fa-calendar mr-r-5 mr-t-5"></i>
                                        Ver todas as atividades
                                    </a>
                                </h6>

                                <ul class="timeline">
                                    <li class="sistema">
                                        <i class="fa fa-cog bg-blue"></i>

                                        <div class="timeline-item">
                                            <span class="time"><i class="fa fa-clock-o"></i> 5 mins atrás</span>

                                            <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                                            <div class="timeline-body">
                                                Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                                weebly ning heekya handango imeem plugg dopplr jibjab, movity
                                                jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                                                quora plaxo ideeli hulu weebly balihoo...
                                            </div>
                                        </div>
                                    </li>

                                    <li>
                                        <i class="feather feather-user bg-aqua"></i>

                                        <div class="timeline-item">
                                            <span class="time"><i class="fa fa-clock-o"></i> 15 dias atrás</span>

                                            <h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request</h3>
                                        </div>
                                    </li>

                                    <li>
                                        <i class="feather feather-user bg-aqua"></i>

                                        <div class="timeline-item">
                                            <span class="time"><i class="fa fa-clock-o"></i> 2 meses atrás</span>

                                            <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                                            <div class="timeline-body">
                                                Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                                weebly ning heekya handango imeem plugg dopplr jibjab, movity
                                                jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                                                quora plaxo ideeli hulu weebly balihoo...
                                            </div>
                                        </div>
                                    </li>
                                </ul>

                            </div>
                            <!-- / Faturas -->
                        </div>

                        <div class="tab-pane" id="emails" aria-expanded="true">
                            <!-- E-mails -->
                            <div class="faturas mr-t-20 bg-white p-3 border-radius-3">
                                <h6 class="mr-b-20 mr-t-0">
                                    <i class="fa fa-envelope mr-r-5"></i>
                                    E-mails

                                    <a href="#" class="f-right fs-15 mr-r-5">
                                        <i class="fa fa-refresh mr-r-5 mr-t-5"></i>
                                        Re-enviar selecionados
                                    </a>
                                </h6>

                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr class="thead-inverse bg-dark-contrast">
                                            <th class="txt-center" style="width: 15px;">
                                                <input type="checkbox" class="selecionaTodos">
                                            </th>
                                            <th>Data de envio</th>
                                            <th>Assunto</th>
                                            <th class="text-right">Situação</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="text-dark">
                                            <td>
                                                <input name="uuid" class="td_item" value="" nome="" type="checkbox">
                                            </td>
                                            <td>27/05/2018 03:00:07</td>
                                            <td><a href="#">Confirmação de pagamento! (#102)</a></td>
                                            <td class="text-right">
                                                <span class="badge badge-red fs-12 py-1 px-2">Não lido</span>
                                            </td>
                                        </tr>
                                        <tr class="text-dark">
                                            <td>
                                                <input name="uuid" class="td_item" value="" nome="" type="checkbox">
                                            </td>
                                            <td>18/06/2018 22:16:54</td>
                                            <td><a href="#">Fatura Criada (#102)</a></td>
                                            <td class="text-right">
                                                <span class="badge badge-orange fs-12 py-1 px-2">Entregue</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- / E-mails -->
                        </div>

                        <div class="tab-pane" id="faturas" aria-expanded="true">
                            <!-- Faturas -->
                            <div class="faturas mr-t-20 bg-white p-3 border-radius-3">
                                <h6 class="mr-b-20 mr-t-0">
                                    <i class="fa fa-dollar mr-r-5"></i>
                                    Faturas

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

                                    <a href="#" class="f-right btn-xs btn-primary fs-13 fw-400 mr-r-5">
                                        <i class="fa fa-check"></i>
                                        Registrar Pagamento
                                    </a>
                                </h6>

                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr class="thead-inverse bg-dark-contrast">
                                            <th class="txt-center" style="width: 15px;">
                                                <input type="checkbox" class="selecionaTodos">
                                            </th>
                                            <th>Criada em</th>
                                            <th>Tipo</th>
                                            <th>Nº da Fatura</th>
                                            <th>Valor</th>
                                            <th>Vencimento</th>
                                            <th class="text-right">Situação</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($customer->invoicesPending as $invoice)
                                            <tr class="text-dark">
                                                <td>
                                                    <input name="uuid" class="td_item" value="" nome="" type="checkbox">
                                                </td>
                                                <td>{{$invoice->created_at->format('d/m/Y H:i')}}</td>
                                                <td>{{$invoice->type_invoice->name}}</td>
                                                <td><a href="{{route('invoice.view', $invoice->uuid)}}">#{{$invoice->id}}</a></td>
                                                <td>R$ {{numFormat($invoice->total)}}</td>
                                                <td>{{$invoice->due->format('d/m/Y')}}</td>
                                                <td class="text-right">
                                                    @if($invoice->status == 0)
                                                        <strong class="text-orange">
                                                            <i class="icone-clock"></i>
                                                            Pendente
                                                        </strong>
                                                    @endif

                                                    @if($invoice->status == 1)
                                                        <strong class="text-green">
                                                            <i class="icone-ok-3"></i>
                                                            Pago
                                                        </strong>
                                                    @endif

                                                    @if($invoice->status == 2)
                                                        <strong class="text-danger">
                                                            <i class="icone-attention-circled"></i>
                                                            Em Atraso
                                                        </strong>
                                                    @endif

                                                    @if($invoice->status == 3)
                                                        <strong class="text-dark">
                                                            <i class="icone-block"></i>
                                                            Cancelado
                                                        </strong>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
                <a href="{{route('customers.edit', $customer->uuid)}}" class="btn btn-block btn-sm btn-primary fs-14">
                    <i class="fa fa-pencil mr-r-5"></i>
                    Editar cliente
                </a>

                <a href="#" class="btn btn-block btn-sm btn-default fs-14">
                    <i class="fa fa-envelope mr-r-5"></i>
                    Enviar mensagem
                </a>

                <a href="#" class="btn btn-block btn-sm btn-default fs-14">
                    <i class="fa fa-user mr-r-5"></i>
                    Logar como cliente
                </a>
                
                <hr class="sep-dot" />

                <a href="#" class="btn btn-block btn-sm btn-default fs-14">
                    <i class="fa fa-dollar mr-r-5"></i>
                    Emitir uma cobrança
                </a>

                <a href="#" class="btn btn-block btn-sm btn-default fs-14">
                    <i class="fa fa-shopping-cart mr-r-5"></i>
                    Adicionar uma assinatura
                </a>

                <hr class="sep-dot" />

                <a href="{{route('customers.view.remove', $customer->uuid)}}" class="btn btn-block btn-sm btn-default color-red fs-14">
                    <i class="fa fa-trash mr-r-5"></i>
                    Remover cliente
                </a>

                <!-- Endereços -->
                <div class="widget-bg widget-notes mr-t-20 border-radius-3">
                    <div class="widget-body profile-user-description p-3">
                        <h6 class="mr-t-0">
                            <i class="fa fa-map-marker mr-r-5 fs-20"></i>
                            Endereço
                        </h6>

                        <div class="contact-details-cell text-left">
                            <p class="mr-b-0 w-100">
                                <small class="heading-font-family fw-500">Principal</small><br />
                                @if($customer->address != null)
                                    {{ $customer->address->address.", ".$customer->address->number }}<br />
                                    {{ $customer->address->additional." - ".$customer->address->district }}<br />
                                    {{ $customer->address->city.", ".$customer->address->uf." - ".$customer->address->zipcode }}<br />
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
                            <i class="fa fa-credit-card mr-r-5 fs-20"></i>
                            Cartões
                        </h6>

                        @forelse($customer->credit_cards as $key => $card)
                            <div class="contact-details-cell text-left">
                                <p class="mr-b-0 w-100">
                                    @if($key == 0)
                                    <small class="heading-font-family fw-500">Principal</small><br />
                                    @else
                                    <small class="heading-font-family fw-500">Adicional</small><br />
                                    @endif

                                    <img src="{{ asset('images/pagamento/'.$card->flag.'.png') }}" class="f-left border mr-r-10" >
                                    <b class="fs-16 fw-500">{{ Mask('####-##', $card->start_number) }}**-****-{{ $card->final_number }}<br /></b>
                                    Validade: {{ $card->expires }}
                                </p>
                            </div>
                        @empty
                            <div class="contact-details-cell text-left">
                                <p class="mr-b-0 w-100">
                                    <small class="heading-font-family fw-500">Principal</small><br />
                                    Nenhum cartão cadastrado.
                                </p>
                            </div>
                        @endforelse
                    </div>
                </div>
                <!-- ./ Cartões -->

            </div>

        </div>
    </div>

@endsection