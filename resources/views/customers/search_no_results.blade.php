@extends('layouts.sistema')

@section('content')
    <div class="col-md-12 content" role="main">
        @if (session('success'))
            <div class="alert alert-success">
                <i class="icone-ok-3"></i>
                {{ session('success') }}
            </div>
        @endif

        @if (session('status'))
            <div class="alert alert-success">
                <i class="icone-ok-3"></i>
                {{ session('status') }}
            </div>
        @endif

        @if (session('deleted'))
            <div class="alert alert-success">
                <i class="icone-ok-3"></i>
                O(A) cliente <b>{{ session('deleted') }}</b> foi excluído(a).
            </div>
        @endif

        <div class="alert alert-success" id="deleteJSON" style="display: none;">
            <i class="icone-ok-3"></i>
            Os <b class="qtd_select"></b> clientes selecionados foram excluídos.
        </div>

        <header class="header-content">
            <h1 class="title-2">Clientes</h1>
        </header>

        <div class="header-menu">
            <div class="row">
                <div class="col-md-6 noPadding-left">
                    <a class="btn btn-primary btn-header" data-toggle="modal" href="{{ route('customers.view.add') }}">
                        <i class="icone-user-add"></i>
                        Adicionar cliente ou fornecedor
                    </a>

                    <a class="btn btn-default btn-header" data-toggle="modal" href="{{ route('customers.view.import') }}">
                        <i class="icone-download-1"></i>
                        Importar
                    </a>

                    <a class="btn btn-default btn-header" rel="excluirClientes">
                        <i class="icone-trash"></i>
                        Excluir
                    </a>
                </div>
                <div class="col-md-4 noPadding-right">
                    <form action="{{ route('customers.search.simple') }}" method="post">
                        {{ csrf_field() }}

                        <div class="input-group form-buscar">
                            <input type="text" name="busca" class="form-control input_busca" placeholder="Pesquisar">
                            <span class="input-group-btn">
                            <button class="btn btn-primary" type="submit">
                                <i class="icone-search"></i>
                            </button>
                        </span>
                        </div>
                    </form>
                </div>
                <div class="col-md-2 noPadding-right text-right">
                    <a href="#" class="btn btn-link bt_searchAdvanced">
                        <i class="caret"></i>
                        Busca avançada
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="search-advanced arrow-up" style="display: none;">
                    <form action="{{ route('customers.search.advanced') }}" method="post">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="tipo">Tipo</label>
                                    <select name="tipo" id="tipo" class="form-control">
                                        <option value="fisica">Pessoa Física</option>
                                        <option value="juridica">Pessoa Jurídica</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="email">E-mail</label>
                                    <input type="text" id="email" name="email" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-3 div_cpf">
                                <div class="form-group">
                                    <label for="cpf">CPF</label>
                                    <input type="text" id="cpf" name="cpf" class="form-control formatCPF" />
                                </div>
                            </div>
                            <div class="col-md-3 div_cnpj" style="display: none;">
                                <div class="form-group">
                                    <label for="cnpj">CNPJ</label>
                                    <input type="text" name="cnpj" id="cnpj" class="form-control formatCNPJ" />
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="telefone">Telefone</label>
                                    <input type="text" id="telefone" name="telefone" class="form-control formatTEL" />
                                </div>
                            </div>
                            <div class="col-md-1">
                                <button type="submit" class="btn btn-primary btn-search-advanced">
                                    <i class="icone-search"></i>
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="checkbox">
                                    <input type="checkbox" id="checkbox-1" name="servicos_ativos" value="sim">
                                    <label for="checkbox-1">Clientes com Serviços Ativos</label>
                                </div>

                                <div class="checkbox">
                                    <input type="checkbox" id="checkbox-2" name="pendencia_financeira" value="sim">
                                    <label for="checkbox-2">Clientes com Pendência Financeira</label>
                                </div>

                                <div class="checkbox">
                                    <input type="checkbox" id="checkbox-3" name="dominios" value="sim">
                                    <label for="checkbox-3">Clientes com Domínios Registrados</label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="no-registry-content">
            <div class="no-result-thumb">
                <img src="{{ asset('images/icons/search_not_found.svg') }}" alt="Busca não encontrada">
            </div>

            <div class="fade-item">
                <h2 class="no-result-title">
                    Oops!
                </h2>

                <div class="no-result-info">
                    <span>
                        Sua busca não teve resultado.
                        <b>Tente novamente.</b>
                    </span>
                </div>
            </div>
        </div>

    </div>

    <!-- InputMask -->
    <script src="{{ asset('plugins/input-mask/jquery.inputmask.js') }}"></script>
    <script src="{{ asset('plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
    <script src="{{ asset('plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>

    <!-- Incluindo o JavaScript -->
    <script type="text/javascript" src="{{ asset('js/widgets/clientes.js') }}"></script>
@endsection