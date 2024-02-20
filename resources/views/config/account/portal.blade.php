@extends('layouts.sistema')

@section('content')
    <div class="row page-title clearfix">
        <div class="page-title-left">
            <h6 class="page-title-heading mr-0 mr-r-5">Portal do cliente</h6>
        </div>

        <!-- Breadcrumb -->
        <div class="page-title-right d-none d-sm-inline-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.html">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="index.html">Configurações</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="index.html">Minha conta</a>
                </li>
                <li class="breadcrumb-item active">Portal do cliente</li>
            </ol>
        </div>
    </div>

    <div class="widget-list">
        <div class="row">
            <div class="col-md-12">
                <div class="form-owner formulario mr-t-20 bg-white p-4 border-radius-3">
                    <h6 class="mr-b-20 mr-t-0">
                        <i class="icone-globe"></i>
                        Configurações gerais
                    </h6>

                    <div class="row pd-t-20 pd-b-10 border-bottom">
                        <div class="col-md-3">
                            <label for="">Nome da Empresa</label>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" class="form-control" name="business" value="{{ $account->name_business }}" />
                            </div>
                        </div>

                        <div class="col-md-5">
                            <p class="mr-t-5">Título exibido no Portal do cliente.</p>
                        </div>
                    </div>

                    <!-- ------------------------------------------------------------------------------------------------->

                    <div class="row pd-t-20 pd-b-10 border-bottom">
                        <div class="col-md-3">
                            <label for="">URL do Portal</label>
                        </div>

                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input class="form-control" id="exampleInputAmount" placeholder="Subdominio" type="text" value="{{ $account->domain }}">
                                            <div class="input-group-addon">.gerentepro.com.br</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="alert alert-warning">
                                        Se alterar o subdomínio, a URL atual será automaticamente desconectada. Será necessário fazer login novamente na nova URL.
                                    </div>
                                    <p class="mr-t-5">
                                        Se quiser que seus clientes e analistas de suporte acessem seu portal de suporte diretamente no seu domínio, aponte a URL de suporte suaempresa.gerentepro.com.br​ para o seu domínio, como suporte.suaempresa.com. <br />
                                        <a href="#">
                                            <i class="icone-question"></i>
                                            Veja nosso passo a passo
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ------------------------------------------------------------------------------------------------->

                    <div class="row pd-t-20 pd-b-20 border-bottom">
                        <div class="col-md-3">
                            <label for="">Logotipo</label>
                        </div>

                        <div class="col-md-3">
                            <input id="logo" name="logotipo" onchange="readURL(this);" type="file" style="display:none;">

                            <div class="well imgTrocaLogo" style="padding:0px; position: relative; float:left;">
                                <img id="myImage" src="@if($account->logo != null) {{ $account->logo }} @else {{ asset('uploads/logos/sample.png') }} @endif" class="img-responsive">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <p class="mr-b-10">A imagem deve conter no máximo 200px de largura e 70px de altura. Utilize o logotipo com o fundo transparente.</p>
                            <a id="selectLogotipo" class="btn btn-sm btn-default fs-14 pd-l-15">
                                <i class="icone-picture-1"></i>
                                Trocar logotipo
                            </a>
                        </div>
                    </div>

                    <!-- ------------------------------------------------------------------------------------------------->

                    <div class="row pd-t-20 pd-b-10 border-bottom">
                        <div class="col-md-3">
                            <label for="">Personalização do Portal</label>
                        </div>

                        <div class="col-md-2">
                            <a href="#" class="btn btn-default btn-sm fs-14 pd-l-15">
                                <i class="icone-code" style="margin-right: 5px;"></i>
                                Personalizar Portal
                            </a>
                        </div>

                        <div class="col-md-7">
                            <p>Se preferir, renove a aparência de seu portal utilizando seu logotipo e personalizando as cores de seu portal.</p>
                        </div>
                    </div>

                    <!-- ------------------------------------------------------------------------------------------------->

                    <div class="row pd-t-20 pd-b-20 border-bottom">
                        <div class="col-md-3">
                            <label for="">Informações de Contato</label>
                        </div>

                        <div class="col-md-4">
                            <input type="text" class="form-control" name="email_contact" placeholder="E-mail de contato" value="{{ $account->email_contact }}">
                        </div>
                    </div>

                    <!-- ------------------------------------------------------------------------------------------------->

                    <div class="row pd-t-20">
                        <div class="col-md-3"></div>

                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary btn-sm fs-14 pd-l-15">
                                <i class="icone-check mr-r-5"></i>
                                Salvar alterações
                            </button>
                        </div>
                    </div>

                    <!-- ------------------------------------------------------------------------------------------------->

                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(function () {
            $('[rel="enviarThumb"]').on('click', function () {
                $('#verArquivo').modal('show');
            });
            $('[rel="selecionarArquivo"]').on('click', function () {
                var url = $(this).data('content');
                $(".thumb_preview").attr("src", url).removeClass("d-none");
                $(".img_thumb").attr("value", url);
                $('#verArquivo').modal('hide');
            });
        });
    </script>
@endsection