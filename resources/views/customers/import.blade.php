@extends('layouts.sistema')

@section('content')
    <div class="col-md-12 content import" role="main">

        <header class="header-content">
            <h1 class="title-2">Importar Cliente e Fornecedores</h1>
        </header>

        <div class="result_import">
            <p class="info-import">
                Com a importação é possível migrar os dados da sua empresa de qualquer software, ERP ou planilha para o GerentePRO.
                <br />
                Baixe a <a href="#">planilha de exemplo</a> e organize as informações conforme as tabelas.
            </p>

            <a href="#" class="btn-importFile">
                <img src="{{ asset('images/icons/icon-csv.png') }}" alt="">
                Baixar a planilha de exemplo
            </a>

            <div class="alert alert-warning">
                Faça upload do arquivo com extensão: <b>.csv</b> e com tamanho máximo de <b>2 MB</b>
            </div>

            <form action="exmaple.php" id="formImport_clientes" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="file" name="arquivo" class="upload_arquivo">
            </form>

            <div class="row help">
                <div class="col-md-12 text-right">
                    <a href="#" class="btn btn-link">
                        Precisa de ajuda? <i class="icone-help-circled"></i>
                    </a>
                </div>
            </div>

            <div class="no-registry-content nenhum_registro">
            <!--
            <div class="no-result-thumb">
                <img src="{{ asset('images/icons/pessoas.svg') }}" alt="Busca não encontrada">
            </div>
            -->

                <div class="fade-item">
                    <h2 class="no-result-title">
                        Importar de outro <b>Software</b>
                    </h2>

                    <div class="no-result-info">
                        <p>
                            Separamos alguns dos softwares mais utilizados no mercado, para facilitar a
                            migração dos seus clientes para o GerentePRO. Não se preocupe! Nenhum dado será perdido ou alterado. Apenas importaremos sua lista de clientes.
                        </p>

                        <div class="buttons">
                            <div class="row">
                                <div class="col-md-3 text-center">
                                    <div class="software">
                                        <img src="{{ asset('images/modules/softwares/whmcs.png') }}" class="img-responsive" alt="">
                                        <a href="{{ route('customers.view.import') }}" class="btn btn-default">
                                            <i class="icone-download-1"></i>
                                            Importar
                                        </a>
                                    </div>
                                </div>

                                <div class="col-md-3 text-center">
                                    <div class="software">
                                        <img src="{{ asset('images/modules/softwares/boxbilling.png') }}" class="img-responsive" style="height: 58px; margin: 0 auto; margin-top: 7px; margin-bottom: 7px;">
                                        <a href="{{ route('customers.view.import') }}" class="btn btn-default">
                                            <i class="icone-download-1"></i>
                                            Importar
                                        </a>
                                    </div>
                                </div>

                                <div class="col-md-3 text-center">
                                    <div class="software">
                                        <img src="{{ asset('images/modules/softwares/isistem.png') }}" class="img-responsive" style="margin-top: 10px; margin-bottom: 17px;">
                                        <a href="{{ route('customers.view.import') }}" class="btn btn-default">
                                            <i class="icone-download-1"></i>
                                            Importar
                                        </a>
                                    </div>
                                </div>

                                <div class="col-md-3 text-center">
                                    <div class="software">
                                        <img src="{{ asset('images/modules/softwares/hostmgr.png') }}" class="img-responsive" style="margin-top: 17px; margin-bottom: 16px;">
                                        <a href="{{ route('customers.view.import') }}" class="btn btn-default">
                                            <i class="icone-download-1"></i>
                                            Importar
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- InputMask -->
    <script src="{{ asset('plugins/input-mask/jquery.inputmask.js') }}"></script>
    <script src="{{ asset('plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
    <script src="{{ asset('plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>

    <!-- Fileuploader -->
    <script src="{{ asset('plugins/fileuploader/jquery.fileuploader.min.js') }}"></script>

    <!-- Incluindo o JavaScript -->
    <script type="text/javascript" src="{{ asset('js/widgets/clientes.js') }}"></script>
@endsection