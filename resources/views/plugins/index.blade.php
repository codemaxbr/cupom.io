@extends('layouts.sistema')

@section('content')

    <!-- Page Title Area -->
    <div class="row page-title clearfix">
        <div class="page-title-left">
            <h6 class="page-title-heading mr-0 mr-r-5">Plugins e Aplicativos</h6>
        </div>
        <!-- /.page-title-left -->
        <div class="page-title-right d-none d-sm-inline-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="{{ route('config.index') }}">Configurações</a>
                </li>
                <li class="breadcrumb-item active">Planos de Assinatura</li>
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

    <div class="widget-list">
        <div class="row">
            <div class="widget-holder col-md-12">
                <div class="tabs tabs-bordered">
                    <ul class="nav nav-tabs">
                        @foreach($tipos as $tipo)
                        <li class="nav-item">
                            <a class="nav-link @if($tipo->id == 1) active @endif" href="#{{ $tipo->slug }}" data-toggle="tab" aria-expanded="true">{{ $tipo->name }}</a>
                        </li>
                        @endforeach
                    </ul>

                    <div class="tab-content border-radius-3 mr-t-10">

                        @foreach($tipos as $key => $tipo)
                        <div class="tab-pane @if($key == 0) active @endif" id="{{ $tipo->slug }}" aria-expanded="true">
                            <div class="row">
                                <div class="col-md-12">

                                    @forelse($tipo->modules as $module)
                                        <div class="card card-plugin">
                                        <div class="card-header">
                                            <a href="javascript:void(0);">
                                                <img src="{{ asset('images/modules/'.$tipo->slug.'/'.$module->logo) }}" alt="">
                                                @if(hasConfig($module))
                                                <span class="triangle-top-right"></span>
                                                @endif
                                            </a>
                                        </div>

                                        <div class="card-body">
                                            <section class="d-flex">
                                                <h5 class="mt-0 mr-auto mr-0-rtl ml-auto-rtl">
                                                    {{ $module->name }}
                                                </h5>
                                            </section>

                                            <span class="fs-14">
                                                {{ $module->description }}
                                            </span>
                                        </div>

                                        <div class="card-footer border-0 d-flex justify-content-between p-0">
                                            @if(hasConfig($module))
                                            <div class="col-md-6 p-3">
                                                <a rel="removerPlugin" data-content="{{ $module->id }}" class="btn btn-xs btn-danger fs-14 pd-l-10 pd-r-10">
                                                    Remover
                                                </a>
                                            </div>

                                            <div class="col-md-6 p-3 pd-l-0">
                                                <a rel="abrirPlugin" data-content="{{ $module->id }}" class="btn btn-xs btn-primary fs-14 pd-l-10 pd-r-10">
                                                    Configurar
                                                </a>
                                            </div>
                                            @else
                                            <div class="col-md-12 text-center p-3">
                                                <a rel="abrirPlugin" data-content="{{ $module->id }}" class="btn btn-xs btn-primary fs-14 pd-l-10 pd-r-10">
                                                    Configurar
                                                </a>
                                            </div>
                                            @endif
                                        </div>
                                    </div>

                                        <!-- Modal -->
                                        <div class="modal fade bs-modal-md" id="removerPlugin-{{$module->id}}" tabindex="-1" role="dialog" aria-labelledby="mExcluirLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-md">
                                                <div class="modal-content" style="width: 400px;">

                                                    <div class="modal-body p-0" id="verCliente" style="background: #fff">
                                                        <div class="col-md-12">
                                                            <div class="row">
                                                                <div class="col-md-12 pd-l-20 pd-b-20 pd-r-20 bg-gray1">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

                                                                    <img src="{{ asset('images/modules/'.$tipo->slug.'/'.$module->logo) }}" class="mr-20 mr-l-0" style="max-height: 40px">
                                                                    <h4 class="modal-title d-inline" id="mExcluirLabel">
                                                                        <span class="plugin-title d-inline-block mr-t-20 f-right">Remover plugin?</span>
                                                                    </h4>

                                                                    <p>
                                                                        <b class="text-red fw-600">Importante!</b><br>
                                                                        O GerentePRO <strong class="text-dark">não poderá</strong> processar automaticamente serviços baseados neste plugin.
                                                                    </p>

                                                                    <hr>
                                                                    <form action="{{ route('plugin.remove', $module->id) }}" method="post" class="config-plugin">
                                                                        @csrf
                                                                        @method('DELETE')

                                                                        <input type="hidden" name="account_id" value="{{ AccountId() }}">

                                                                        <button type="submit" class="btn btn-xs btn-danger fs-14 text-white mr-r-5">
                                                                            <i class="icone-trash"></i>
                                                                            Remover
                                                                        </button>
                                                                        <button type="button" class="btn btn-xs btn-default fs-14" data-dismiss="modal">Cancelar</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div>
                                        <!-- /.modal -->
                                    @empty
                                        Oops! Nenhum módulo para este tipo ainda. :(
                                    @endforelse
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- /.widget-holder -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.widget-list -->


    <!-- Modal -->
    <div class="modal fade" id="modalPlugin" tabindex="-1" role="dialog" aria-labelledby="mPluginLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="width: 850px;"></div>
        </div>
    </div>

    <!-- InputMask -->
    <script src="{{ asset('plugins/input-mask/jquery.inputmask.js') }}"></script>
    <script src="{{ asset('plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
    <script src="{{ asset('plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>

    <!-- Incluindo o JavaScript -->
    <script type="text/javascript">
        $(function(){
            $('[rel="abrirPlugin"]').on('click', function(){
                var plugin = $(this).data('content');

                $.ajax({
                    type: 'GET',
                    url: '{{ route('plugins.app', '_plugin_') }}'.replace('_plugin_', plugin),
                    dataType: 'html',
                    success: function(data){
                        $('#modalPlugin').modal('show');
                        $('#modalPlugin .modal-content').html(data);
                    },
                    error: function(error){
                        $('#modalPlugin').modal('show');
                        $('#modalPlugin .modal-content').html(error.responseText);
                    }
                });
            });

            $('[rel="removerPlugin"]').on('click', function(){
                var plugin = $(this).data('content');

                $('#removerPlugin-'+plugin).modal('show');
            });
        });
    </script>
@endsection