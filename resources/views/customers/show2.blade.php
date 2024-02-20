@extends('layouts.sistema')
@section('content')

    <div class="col-md-9 content" role="main">
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
        <header class="header-content">
            <h1 class="title-2">
                @if($customer->type == "fisica")
                <!--<i class="icone-user-1"></i>-->
                @else
                <!-- <i class="icone-building"></i>-->
                @endif

                {{ $customer->name }}
            </h1>
            <small>
                <span class="contatos">
                    <i class="icone-mail"></i>
                    <b>{{ $customer->email }}</b>
                </span>

                @if($customer->phone != "")
                <span class="contatos">
                    <i class="icone-phone"></i>
                    <b>{{ $customer->phone }}</b>
                </span>
                @endif

                @if($customer->mobile != "")
                    <span class="contatos">
                    <i class="icone-phone"></i>
                    <b>{{ $customer->mobile }}</b>
                </span>
                @endif
            </small>
        </header>

        <div class="box-info profile">

            <header>
                <div class="col-md-3 text-center">
                    <h2>R$ 0,00</h2>
                    <span class="legenda">Saldo</span>
                </div>

                <div class="col-md-3 text-center">
                    <h2>R$ 0,00</h2>
                    <span class="legenda">Dentro do Prazo</span>
                </div>

                <div class="col-md-3 text-center">
                    <h2 class="color-red">R$ 0,00</h2>
                    <span class="legenda">Vencido</span>
                </div>

                <div class="col-md-3 text-center">
                    <h2>0 dias</h2>
                    <span class="legenda">Média de pagamento</span>
                </div>
            </header>

            <div class="box-info-grid">
                <div class="row">
                    <div class="col-md-12">
                        <h4>Detalhes</h4>
                    </div>
                </div>

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
                                @if($customer->type == "fisica")
                                    <b>CPF:</b>
                                @else
                                    <b>CNPJ:</b>
                                @endif
                            </div>
                            <div class="col-md-8 no-padding-left">
                                {{ $customer->cpf_cnpj }}
                            </div>
                        </div>

                        @if($customer->type == "fisica")
                            <div class="row">
                                <div class="col-md-4">
                                    <b>Nascimento:</b>
                                </div>
                                <div class="col-md-8 no-padding-left">
                                    {{ dateFormat($customer->birthdate, 'd/m/Y') }}
                                </div>
                            </div>
                        @else
                            <div class="row">
                                <div class="col-md-4">
                                    <b>Ins. Municipal:</b>
                                </div>
                                <div class="col-md-8 no-padding-left">
                                    {{ $customer->ins_municipal }}
                                </div>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-4">
                                <b>Endereço:</b>
                            </div>
                            <div class="col-md-8 no-padding-left">
                                @if($customer->address != "")
                                    {{ $customer->address.", ".$customer->number." - ".$customer->additional.", ".$customer->district }}
                                @else
                                    -
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <b>CEP:</b>
                            </div>
                            <div class="col-md-8 no-padding-left">
                                {{ ($customer->zipcode != "") ? $customer->zipcode : "-" }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-5">
                                <b>Cidade:</b>
                            </div>
                            <div class="col-md-7 no-padding-left">
                                @if($customer->city != "")
                                    {{ $customer->city.", ".$customer->uf }}
                                @else
                                    -
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-5">
                                <b>Nome Fantasia:</b>
                            </div>
                            <div class="col-md-7 no-padding-left">
                                {{ ($customer->business != "") ? $customer->business : "-" }}
                            </div>
                        </div>

                        @if($customer->type == "juridica")
                        <div class="row">
                            <div class="col-md-5">
                                <b>Ins. Estadual:</b>
                            </div>
                            <div class="col-md-7 no-padding-left">
                                {{ ($customer->ins_estadual != "") ? $customer->ins_estadual : "-" }}
                            </div>
                        </div>
                        @endif

                        <div class="row">
                            <div class="col-md-5">
                                <b>WhatsApp:</b>
                            </div>
                            <div class="col-md-7 no-padding-left">
                                {{ ($customer->ins_estadual != "") ? $customer->ins_estadual : "-" }}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-5">
                                <b>Skype:</b>
                            </div>
                            <div class="col-md-7 no-padding-left">
                                {{ ($customer->ins_estadual != "") ? $customer->ins_estadual : "-" }}
                            </div>
                        </div>
                    </div>

                    <!--
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-3">
                                <b>CEP</b>
                                {{ $customer->zipcode }}
                            </div>

                            <div class="col-md-7">
                                <b>Endereço</b>
                                {{ $customer->address }}
                            </div>

                            <div class="col-md-1 no-padding-left">
                                <b>Número</b>
                                {{ $customer->number }}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <b>Complemento</b>
                                {{ $customer->additional }}
                            </div>

                            <div class="col-md-4">
                                <b>Bairro</b>
                                {{ $customer->district }}
                            </div>

                            <div class="col-md-5 no-padding">
                                <b>Cidade</b>
                                {{ $customer->city.", ".$customer->uf }}
                            </div>
                        </div>
                    </div>
                    -->
                </div>
            </div>
        </div>

        <div class="box-details">
            <header>
                <h3>Serviços Contratados</h3>
                <hr class="sep-dot">
            </header>

            <div class="ls-list">
                <header class="ls-list-header">
                    <div class="ls-group-actions">
                        <a href="#" class="btn btn-sm btn-primary f-left">
                            <i class="icone-popup-3"></i>
                            Painel de Controle
                        </a>
                        <div class="btn-group btn-group-sm">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu pull-right" role="menu">
                                <li>
                                    <a href="#">
                                        <i class="icone-off"></i>
                                        Suspender
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="icone-arrows-cw-1"></i>
                                        Trocar Plano
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="icone-cog"></i>
                                        Personalizar
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="#" class="color-danger">
                                        <i class="icone-trash"></i>
                                        Remover
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="ls-list-image">
                        <img alt="linux" src="{{ asset('images/modules/panel/cpanel2.png') }}">
                    </div>

                    <div class="ls-list-title">
                        <a href="">Hospedagem de Sites</a>
                        <small>Plano: Fácil 1GB - R$ 29,90 /mês
                            <a href="#" class="ico-question" data-container="body" data-inherit="background-color" data-toggle="popover" data-placement="top" data-content="Um texto bem legal e bonito por aqui." data-title="Título" data-original-title="" title=""></a>
                        </small>
                    </div>
                </header>

                <div class="ls-list-content" style="display: none;">
                    <div class="col-xs-6 col-md-2">
                        <strong class="ls-list-label">Status</strong>
                        Publicado
                    </div>
                    <div class="col-xs-6 col-md-2">
                        <strong class="ls-list-label">Status</strong>
                        Publicado
                    </div>
                </div>
            </div>

            <div class="ls-list">
                <header class="ls-list-header">
                    <div class="ls-group-actions">
                        <a href="#" class="btn btn-sm btn-default f-left">
                            <i class="icone-popup-3"></i>
                            Painel de Controle
                        </a>
                        <div class="btn-group btn-group-sm">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu pull-right" role="menu">
                                <li>
                                    <a href="#">
                                        <i class="icone-off"></i>
                                        Suspender
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="icone-arrows-cw-1"></i>
                                        Trocar Plano
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="icone-cog"></i>
                                        Personalizar
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="#" class="color-danger">
                                        <i class="icone-trash"></i>
                                        Remover
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="ls-list-image">
                        <img alt="linux" src="{{ asset('images/modules/panel/whmsonic.png') }}">
                    </div>

                    <div class="ls-list-title">
                        <a href="">Streaming</a>
                        <small>Plano: Fácil 1GB - R$ 29,90 /mês
                            <a href="#" class="ico-question" data-container="body" data-inherit="background-color" data-toggle="popover" data-placement="top" data-content="Um texto bem legal e bonito por aqui." data-title="Título" data-original-title="" title=""></a>
                        </small>
                    </div>
                </header>

                <div class="ls-list-content" style="display: none;">
                    <div class="col-xs-6 col-md-2">
                        <strong class="ls-list-label">Status</strong>
                        Publicado
                    </div>
                    <div class="col-xs-6 col-md-2">
                        <strong class="ls-list-label">Status</strong>
                        Publicado
                    </div>
                </div>
            </div>
        </div>

        <div class="box-details">
            <header>
                <h3>Histórico financeiro</h3>
                <p>Escolha um mês e clique em <i>Ver mês</i> para visualizar o histórico do mês correspondente</p>
            </header>

            <div class="box-filtro" style="padding: 15px; margin-top: 15px; margin-bottom: 0px;">
                <div class="col-md-5">
                    <div class="input-group">
                        <select name="select-multiplo" class="form-control ls-select" placeholder="" style="width:200px">
                            <option value="MG">Janeiro / 2018</option>
                            <option value="SP">Fevereiro / 2018</option>
                            <option value="RJ">Março / 2018</option>
                        </select>
                        <span class="input-group-btn">
										<button class="btn btn-default" type="button">
											<i class="icone-search"></i>
											Ver mês
										</button>
									</span>
                    </div>
                </div>
                <div class="col-md-7 text-right">
                    <span class="label">Janeiro/2018</span>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table ls-table" id="tabela2">
                    <!--
                    <thead>
                        <tr>
                            <th>Data</th>
                            <th>Descrição</th>
                            <th>Transação</th>
                            <th></th>
                            <th class="hidden-xs text-right">Saldo</th>

                        </tr>
                    </thead>
                    -->
                    <tbody>
                    <tr>
                        <td class="col-md-2">01/01/2018</td>
                        <td class="col-md-6 p">Saldo do mês anterior</td>
                        <td class="col-md-2"></td>
                        <td>=</td>
                        <td class="col-md-2 text-right">
                            R$ 9.999,00
                        </td>
                    </tr>

                    <tr>
                        <td class="col-md-2">02/01/2018</td>
                        <td class="col-md-6 p">
                            Hospedagem de Sites - Fácil 1GB
                        </td>
                        <td class="col-md-2">
                            <a href="#">0912309412</a>
                        </td>
                        <td>-</td>
                        <td class="col-md-2 text-right">
                            R$ 99,00
                        </td>
                    </tr>

                    <tr>
                        <td class="col-md-2">03/01/2018</td>
                        <td class="col-md-6 p">Outro item para cobrar</td>
                        <td class="col-md-2">
                            <a href="#">0912309412</a>
                        </td>
                        <td>+</td>
                        <td class="col-md-2 text-right">
                            R$ 9,00
                        </td>
                    </tr>

                    <tr>
                        <td class="col-md-2">31/01/2018</td>
                        <td class="col-md-6 p">Saldo do mês Janeiro/2018</td>
                        <td class="col-md-2"></td>
                        <td>=</td>
                        <td class="col-md-2 text-right">
                            R$ 9.999,00
                        </td>
                    </tr>

                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <aside class="sidebar col-md-3" role="complementary">

        <a class="btn btn-primary btn-header" href="{{ route('customers.view.edit', $customer->uuid) }}">
            <i class="icone-pencil"></i>
            Editar cliente
        </a>

        <a class="btn btn-default btn-header" href="#addContato">
            <i class="icone-mail-3"></i>
            Enviar mensagem
        </a>

        <a class="btn btn-default btn-header" href="#addContato">
            <i class="icone-user-1"></i>
            Logar como cliente
        </a>

        <hr class="sep-dot">

        <a class="btn btn-default btn-header" href="#addContato">
            <i class="icone-dollar"></i>
            Emitir uma Cobrança
        </a>

        <a class="btn btn-default btn-header" href="#addContato">
            <i class="icone-basket-3"></i>
            Adicionar um Serviço
        </a>

        <hr class="sep-dot">

        <a class="btn btn-default btn-header color-red" href="{{ route('customers.view.remove', $customer->uuid) }}">
            <i class="icone-trash"></i>
            Remover cliente
        </a>

        <section class="sidebox">
            <h1 class="sidebox-title icone-question">Ajuda</h1>
            <div class="sidebox-inner">
                <p>
                    <b>Campos Obrigatórios</b><br />
                    Fique atento aos dados CPF, CNPJ, Data de Nascimento e E-mail. Estes dados são obrigatórios para evitar qualquer tipo de problema com cadastros inválidos ou SPAM.
                </p>
            </div>

            <div class="sidebox-inner">
                <p>
                    <b>E-mail Autenticado</b><br />
                    Todas as operações com interação do cliente será enviado uma notificação por e-mail para acompanhamento e validação.
                </p>
                <p>
                    Se o e-mail digitado for inválido, o cadastro será desativado em 48h.
                </p>
            </div>
        </section>
    </aside>
@endsection