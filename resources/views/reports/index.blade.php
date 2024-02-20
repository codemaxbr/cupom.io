@extends('layouts.sistema')
@section('content')

    <!-- Page Title Area -->
    <div class="row page-title clearfix">
        <div class="page-title-left">
            <h6 class="page-title-heading mr-0 mr-r-5">Relatórios</h6>
        </div>
        <!-- /.page-title-left -->
        <div class="page-title-right d-none d-sm-inline-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Relatórios</li>
            </ol>
        </div>
        <!-- /.page-title-right -->
    </div>
    <!-- /.page-title -->
    <!-- =================================== -->
    <!-- Different data widgets ============ -->
    <!-- =================================== -->
    <div class="widget-list">
        <div class="row">
            <div class="col-md-12 widget-holder">
                <div class="widget-bg">
                    <div class="widget-body search-results clearfix">

                        <div class="row">

                            <div class="col-md-4 pd-lr-15">
                                <h5 class="box-title fs-14 mt-3">
                                    Vendas
                                </h5>

                                <ul class="search-list list-unstyled mt-4">
                                    <li class="d-flex">
                                        <i class="material-icons list-icon text-muted fs-20 mr-2 mr-0-rtl ml-3-rtl">chevron_right</i>
                                        <div>
                                            <a href="{{ route('reports.sales.plan') }}" class="fs-15 mt-0 mb-1 block">Vendas por plano</a>
                                        </div>
                                    </li>

                                    <li class="d-flex">
                                        <i class="material-icons list-icon text-muted fs-20 mr-2 mr-0-rtl ml-3-rtl">chevron_right</i>
                                        <div>
                                            <a href="{{ route('reports.sales.period') }}" class="fs-15 mt-0 mb-1 block">Vendas por período</a>
                                        </div>
                                    </li>

                                    <li class="d-flex">
                                        <i class="material-icons list-icon text-muted fs-20 mr-2 mr-0-rtl ml-3-rtl">chevron_right</i>
                                        <div>
                                            <a href="{{ route('reports.sales.partner') }}" class="fs-15 mt-0 mb-1 block">Vendas por parceiro</a>
                                        </div>
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
@endsection