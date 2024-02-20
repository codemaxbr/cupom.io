@extends('layouts.sistema')

@section('content')
    <div class="row page-title clearfix">
        <div class="page-title-left">
            <h6 class="page-title-heading mr-0 mr-r-5">Resumo Financeiro</h6>
            <p class="page-title-description mr-0 d-none d-md-inline-block"></p>
        </div>
        <div class="page-title-right d-none d-sm-inline-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{route('home')}}">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{route('invoices.index')}}">Faturas</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="">Resumo financeiro</a>
                </li>
                <li class="breadcrumb-item active"></li>
            </ol>
        </div>
    </div>
    <div class="widget-list">
        <div class="row">
            <div class="left-sidebar">
                <div class="widget-bg bg-white p-3 border-radius-3 pos-relative" style="height: 100%">
                    <div class="row pd-tb-10">
                        <div class="col-md-2" >
                            <input type="checkbox" id="checkbox-1">
                        </div>
                        <div class="col-md-7" >
                            <b>Caixinha</b>
                        </div>
                        <div class="col-md-3" style=" width: 100%">
                            <b>8.900,00</b>
                        </div>
                    </div>
                    <div class="row pd-tb-10" style="border-top: 1px solid #e1e7e8" >
                        <div class="col-md-2" >
                            <input type="checkbox" id="checkbox-2">
                        </div>
                        <div class="col-md-7" >
                            <b>Caixinha</b>
                        </div>
                        <div class="col-md-3" >
                            <b>8.900,00</b>
                        </div>
                    </div>
                    <div class="row  pd-tb-10" style="border-top: 1px solid #e1e7e8" >
                        <div class="col-md-2" >
                            <input type="checkbox" id="checkbox-3">
                        </div>
                        <div class="col-md-7" >
                            <b>Caixinha</b>
                        </div>
                        <div class="col-md-3">
                            <b>8.900,00</b>
                        </div>
                    </div>
                    <div class="row pos-absolute pd-tb-20" style="bottom: 0;width: 100%;border-top: 1px solid #e1e7e8">
                        <div class="col-md-8 " >
                            <b>SALDO</b>
                        </div>
                        <div class="col-md-4 " >
                            <b>125.000,00</b>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-with-sidebar pd-l-20">
                <div class="widget-bg bg-white p-3 border-radius-3">
                    <div class="row">
                        <div class="col-md-8">
                            <h6 class="mr-b-10 mr-t-0 pd-t-20">
                                <i class="fa fa-bar-chart"></i>
                                Gradient Area Chart
                            </h6>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <div class="input-group input-has-value">
                                    <input type="text" name="busca-de" value="" class="form-control" id="datepicker">
                                    <span class="input-group-addon">
                                            <i class="icone-calendar"></i>
                                        </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <div class="input-group input-has-value">
                                    <input type="text" name="busca-ate" value="" class="form-control" id="datepicker">
                                    <span class="input-group-addon">
                                            <i class="icone-calendar"></i>
                                        </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-md-12 widget-holder">
                            <div class="widget-bg">
                                <div class="widget-body clearfix">
                                    <div style="height: 230px">
                                        <canvas id="chartJsLineSingleGradient"></canvas>
                                    </div>
                                </div>
                                <!-- /.widget-body -->
                            </div>
                            <!-- /.widget-bg -->
                        </div>
                        <!-- /.widget-holder -->
                    </div>
                </div>
            </div>
            <div class="widget-holder col-md-12 mr-t-5">

                <div class="widget-bg">
                    <div class="widget-body">
                        <div class="mail-inbox-header">
                            <div class="col-md-12">
                                <div class="mail-inbox-tools d-flex align-items-center">
                                    <div class="col-md-12 widget-bg bg-white p-3 border-radius-3">
                                        <div class="row">
                                            <h6 class="mr-b-10 mr-t-0 pd-t-10 pd-l-5">
                                                <i class="fa fa-credit-card-alt"></i>
                                                Extrato Financeiro
                                            </h6>
                                            <div class="col-md-3">
                                                <a href="{{ route('customers.view.import') }}" class="btn btn-sm btn-link mr-2 fs-14">
                                                    <i class="list-icon fs-18 mr-r-5 fa fa-download" style="margin-top: 5px;"></i> <strong>Exportar</strong>
                                                </a>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-input-icon">
                                                    <i class="fa fa-calendar list-icon"></i>
                                                    <input class="form-control daterange" id="l6" placeholder="Período" type="text">
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <button type="submit" class="btn btn-sm btn-block btn-primary fs-14">Buscar</button>
                                            </div>
                                            <div class="col-md-3">
                                                <h4>
                                                    <span class="counter-title pull-right text-dark fs-25">
                                                         {{ mesExtenso() }}<strong class="text-muted">/{{ date('Y') }}</strong>
                                                    </span>
                                                </h4>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <table class="table table-hover" style="width:100%">
                                <thead>
                                <tr>
                                    <th><input type="checkbox"></th>
                                    <th>Data</th>
                                    <th>Cliente</th>
                                    <th>Descrição</th>
                                    <th><i class="icone-up-open color-green"></i>Entrada</th>
                                    <th><i class="icone-down-open color-red"></i>Saída</th>

                                </tr>
                                </thead>
                                <tbody>
                                @forelse($statements as $statement)
                                    <tr>
                                        <td>{{$statement->id}}</td>
                                        <td>{{dateFormat($statement->created_at)}}</td>
                                        <td>{{$statement->customer->name}}</td>
                                        <td>{{$statement->name}}</td>
                                        <td>
                                            @if($statement->type == 'credito')
                                                {{"R$ ".number_format($statement->total).",00"}}

                                            @endif
                                        </td>
                                        <td>
                                            @if($statement->type == 'debito')
                                                {{number_format($statement->total)}}
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">
                                            Nenhuma transação encontrada
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-7 mt-1 pd-l-10">
                            <span class="headings-font-family">
                                Exibindo de {{ $statements->firstItem() }} à {{ $statements->lastItem() }} de <b>{{ $statements->total() }}</b> registros
                            </span>
                            </div>

                            <div class="col-md-5">
                                <div class="btn-group float-right">
                                    {{ $statements->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection