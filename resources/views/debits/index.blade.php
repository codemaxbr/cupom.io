@extends('layouts.sistema')
@section('content')
    <!-- Page Title Area -->
    <div class="row page-title clearfix">
        <div class="page-title-left">
            <h6 class="page-title-heading mr-0 mr-r-5">Contas à Pagar</h6>
        </div>

        <div class="page-title-right d-none d-sm-inline-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">Financeiro</a>
                </li>
                <li class="breadcrumb-item active">Contas à Pagar</li>
            </ol>
        </div>
        <!-- /.page-title-right -->
    </div>
    <!-- /.page-title -->

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
            <!-- Filtro e Resumo -->
            <div class="actions-sidebar pd-l-0 pd-r-20">
                <div class="detalhes mr-t-10 bg-white p-3 border-radius-3">
                    <div class="counter-w-info media mr-t-0">
                        <div class="media-body">
                            <p class="mr-b-5 fs-13">SALDO EM CAIXA</p>
                            <span class="counter-title text-green fs-25">
                                <strong>R$ 1.000,00</strong>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="detalhes mr-t-5 bg-white p-3 border-radius-3">
                    <div class="counter-w-info media mr-t-0">
                        <div class="media-body">
                            <p class="mr-b-5 fs-13">TOTAL A PAGAR</p>
                            <span class="counter-title text-dark fs-25">
                                <strong>R$ 2.443,43</strong>
                            </span>

                            <hr>

                            <p class="mr-t-5 mr-b-0">SALDO FINAL: <strong class="fs-15">R$ 12.000,00</strong></p>
                        </div>
                    </div>
                </div>

                <div class="detalhes mr-t-5 bg-white p-3 border-radius-3">
                    <div class="counter-w-info media mr-t-0">
                        <div class="media-body">
                            <p class="mr-b-5 fs-13">FILTRO DE BUSCA</p>

                            <div class="checkbox checkbox-primary">
                                <label class="checkbox-checked">
                                    <input type="checkbox" checked="checked"> <span class="label-text text-dark-light">Todos</span>
                                </label>
                            </div>

                            <div class="checkbox checkbox-primary">
                                <label class="checkbox-checked">
                                    <input type="checkbox" checked="checked"> <span class="label-text text-dark-light">Contas pendentes</span>
                                </label>
                            </div>

                            <div class="checkbox checkbox-primary">
                                <label class="checkbox-checked">
                                    <input type="checkbox" checked="checked"> <span class="label-text text-dark-light">Contas pagas</span>
                                </label>
                            </div>

                            <div class="checkbox checkbox-primary">
                                <label class="checkbox-checked">
                                    <input type="checkbox" checked="checked"> <span class="label-text text-dark-light">Contas vencidas</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Fim do Filtro e Resumo -->
            <div class="content-with-sidebar pd-t-10">
                <div class="widget-holder col-md-12">

                    <div class="widget-bg border-radius-3">
                        <div class="widget-body p-2 mr-b-20">

                            <div class="mail-inbox-header">
                                <div class="col-md-7">

                                    <div class="mail-inbox-tools d-flex align-items-center">
                                        <div class="d-none d-sm-block text-right mr-r-20">
                                            <a href="{{ route('invoices.view.add') }}" class="btn btn-primary btn-sm fs-14 pd-r-10 pd-l-15">
                                                <i class="icone-doc-new"></i>
                                                Incluir despesa
                                            </a>
                                        </div>

                                        <div class="btn-group">
                                            <a href="{{ route('customers.view.import') }}" class="btn btn-sm btn-link mr-2 fs-14">
                                                <i class="list-icon fs-18 mr-r-5 fa fa-download" style="margin-top: 5px;"></i> <strong>Exportar</strong>
                                            </a>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-md-5 text-right">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="form-input-icon">
                                                <i class="fa fa-calendar list-icon"></i>
                                                <input class="form-control daterange" id="l6" placeholder="Período" type="text">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <button type="submit" class="btn btn-sm btn-block btn-primary fs-14">
                                                <i class="icone-search"></i>
                                                Buscar
                                            </button>
                                        </div>
                                    </div>
                                    <!-- /.mail-inbox-tools -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <table class="table table-hover" id="tabela_clientes">
                        <tbody>

                            @foreach($debits as $debit)
                            <tr class="table-div">
                                <td>
                                    <a href="#">{{ $debit->provider->name }} @if($debit->provider->fantasia != null)({{ $debit->provider->fantasia }})@endif</a>
                                    <span class="text-dark-light">Nº DOC: <strong class="fs-15">{{ $debit->n_document }}</strong></span>
                                </td>
                                <td>
                                    <span class="d-block">
                                        Vencimento: <strong class="fs-15">{{ $debit->due->format('d/m/Y') }}</strong>
                                    </span>
                                </td>

                                <td>
                                    <span class="d-block">
                                        Valor: <strong class="fs-15">R$ {{ numFormat($debit->total) }}</strong>
                                    </span>
                                </td>

                                <td>
                                    @if($debit->paid != null)
                                    <strong class="text-green">
                                        <i class="icone-ok-3"></i>
                                        Pago
                                    </strong>
                                    @endif

                                    @if($debit->paid == null && $debit->due >= \Illuminate\Support\Carbon::today())
                                    <strong class="text-danger">
                                        <i class="icone-attention-circled"></i>
                                        Pagamento pendente
                                    </strong>
                                    @endif

                                    @if($debit->paid == null && $debit->due < \Illuminate\Support\Carbon::parse(now()))
                                    <strong class="text-muted">
                                        <i class="icone-clock"></i>
                                        Vencida
                                    </strong>
                                    @endif
                                </td>

                                <td class="text-right">
                                    <a href="#" class="table-actions">
                                        <i class="icone-ok"></i>
                                    </a>

                                    <a href="#" class="table-actions">
                                        <i class="icone-pencil"></i>
                                    </a>

                                    <a href="#" class="table-actions">
                                        <i class="icone-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection