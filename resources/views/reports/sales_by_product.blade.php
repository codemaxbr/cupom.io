@extends('layouts.sistema')

@section('content')

    <!-- Page Title Area -->
    <div class="row page-title clearfix">
        <div class="page-title-left">
            <h6 class="page-title-heading mr-0 mr-r-5">Relatório de vendas por plano</h6>
            <!--<p class="page-title-description mr-0 d-none d-md-inline-block">statistics, charts and events</p>-->
        </div>
        <!-- /.page-title-left -->
        <div class="page-title-right d-none d-sm-inline-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">Relatórios</a>
                </li>
                <li class="breadcrumb-item active">Vendas por plano</li>
            </ol>
        </div>
        <!-- /.page-title-right -->
    </div>
    <div class="widget-list">
        <div class="row">

            <!-- Filtro de busca -->
            <div class="widget-holder col-md-12 mr-b-10">
                <div class="widget-bg border-radius-3">
                    <div class="widget-body pd-lr-20 pd-t-10 pd-b-5">
                        <div class="mail-inbox-header">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="mail-inbox-tools d-flex align-items-center">

                                        <div class="btn-group">
                                            <a href="{{ route('customers.view.import') }}" class="btn btn-sm btn-link mr-2 fs-14">
                                                <i class="list-icon fs-18 mr-r-5 fa fa-download" style="margin-top: 5px;"></i> <strong>Exportar</strong>
                                            </a>

                                            <div class="dropdown">
                                                <a href="javascript:void(0)" data-toggle="dropdown" class="btn btn-sm fs-14 fw-semibold btn-link dropdown-toggle headings-color">
                                                    <i class="feather feather-more-vertical text-muted fs-18 mr-2"></i> Ações
                                                </a>
                                                <div role="menu" class="dropdown-menu">
                                                    <a class="dropdown-item" href="javascript:void(0)">Enviar Lembrete</a>
                                                    <a class="dropdown-item" href="javascript:void(0)">Gerar cupom</a>
                                                    <a class="dropdown-item" href="javascript:void(0)">Converter em Pedido</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item text-red" href="javascript:void(0)">Remover</a>
                                                </div>
                                            </div>
                                            <!-- /.dropdown -->
                                        </div>
                                        <!-- /.btn-group -->
                                    </div>
                                </div>
                                <!-- /.mail-inbox-tools -->
                            </div>

                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-12 d-inline-block pull-right">
                                        <form action="{{ route('customers.search.simple') }}" method="get">
                                            {{ csrf_field() }}

                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-6 pull-right">
                                                    <div class="form-input-icon">
                                                        <i class="fa fa-calendar list-icon"></i>
                                                        <input class="form-control daterange" id="l6" placeholder="Período" type="text">
                                                    </div>
                                                </div>

                                                <div class="col-md-3 pull-right">
                                                    <select name="" id="" class="form-control selectpicker">
                                                        <option value="-">Todos</option>
                                                        <option value="0">Abandonado</option>
                                                        <option value="1">Recuperado</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-2 pull-right">
                                                    <button type="submit" class="btn btn-sm btn-block btn-primary fs-14">Buscar</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Filtro de busca -->

            <div class="widget-holder col-md-12">
                <div class="widget-bg border-radius-3">
                    <div class="widget-body">
                        <div class="row">

                            <div class="col-md-12 text-center">
                                <h5 class="mr-b-5 mr-t-0 pd-t-10 pd-l-5">
                                    Relatório de vendas por plano
                                </h5>
                                <p>01/10/2018 - 04/10/2018</p>
                            </div>

                            <table class="table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Nome do plano</th>
                                        <th>Novas</th>
                                        <th>Total Novas</th>
                                        <th>Recorrências</th>
                                        <th>Total Recorrências</th>
                                        <th>Total Geral</th>
                                        <th>Valor Total</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse($reports as $report)
                                        <tr>
                                            <td class="text-primary">{{ $report->plan->name }}</td>
                                            <td>{{ $report->totalPedido()->count() }}</td>
                                            <td>{{ $report->totalPedido()->sum('total') }}</td>
                                            <td>43</td>
                                            <td>123,00</td>
                                            <td><b class="text-dark">654</b></td>
                                            <td><b class="text-dark">435,00</b></td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7">Nenhuma venda registrada até o momento.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <ul class="pagination pagination-sm mr-t-0 mr-b-20 pull-right">
                                    <li class="page-item"><a class="page-link" href="#" aria-label="Previous"><span aria-hidden="true"><i class="feather feather-chevron-left"></i></span></a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">1</a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">2</a>
                                    </li>
                                    <li class="page-item active"><a class="page-link" href="#">3</a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">4</a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">5</a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#" aria-label="Next"><span aria-hidden="true"><i class="feather feather-chevron-right"></i></span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- /.widget-body -->
                </div>
                <!-- /.widget-bg -->
            </div>
            <!-- /.widget-holder -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.widget-list -->
    <!-- InputMask -->
    <script src="{{ asset('plugins/input-mask/jquery.inputmask.js') }}"></script>
    <script src="{{ asset('plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
    <script src="{{ asset('plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>
    <!-- Incluindo o JavaScript -->
    <script type="text/javascript" src="{{ asset('js/widgets/invoices.js') }}"></script>
@endsection