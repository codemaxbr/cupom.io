@extends('layouts.sistema')
@section('content')
    <div class="row page-title clearfix">
        <div class="page-title-left">
            <h6 class="page-title-heading mr-0 mr-r-5">Minha conta</h6>
        </div>
        <div class="page-title-right d-none d-sm-inline-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">Dashboard</a>
                </li>

                <li class="breadcrumb-item">
                    <a href="{{ route('config.index') }}">Configurações</a>
                </li>

                <li class="breadcrumb-item active">Meu Plano</li>
            </ol>
        </div>
    </div>

    <!-- =================================== -->
    <!-- Different data widgets ============ -->
    <!-- =================================== -->
    <div class="widget-list">
        <div class="row">
            <div class="col-md-12">
                <!-- Tabs -->
                <div class="tabs tabs-bordered">
                    <ul class="nav nav-tabs">
                        <li class="nav-item" aria-expanded="false">
                            <a class="nav-link active" href="#meu-plano" data-toggle="tab" aria-expanded="true">Meu plano</a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link" href="#historico" data-toggle="tab" aria-expanded="false">Histórico de cobranças</a>
                        </li>
                    </ul>

                    <div class="tab-content bg-none p-0">

                        <div class="tab-pane active" id="meu-plano" aria-expanded="true">

                            <div class="row">
                                <div class="col-md-6">
                                    <!-- Faturas -->
                                    <div class="form-owner formulario mr-t-20 bg-white p-4 border-radius-3">
                                        <h6 class="mr-b-20 mr-t-0">
                                            <i class="icone-user-1 mr-r-5"></i>
                                            Dados do titular da licença
                                        </h6>

                                        <div class="form-group">
                                            <label for="">Tipo de contrato <b class="text-red">*</b></label>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="radiobox">
                                                        <label>
                                                            <input type="radio" name="type" value="2" checked="checked">
                                                            <span class="label-text fs-15">Pessoa Física</span>
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="radiobox">
                                                        <label>
                                                            <input type="radio" name="type" value="1" checked="checked">
                                                            <span class="label-text fs-15">Pessoa Jurídica</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="">E-mail principal <b class="text-red">*</b></label>
                                            <input type="text" name="email" class="form-control" />
                                        </div>

                                        <div class="form-group">
                                            <label for="">Nome / Razão Social <b class="text-red">*</b></label>
                                            <input type="text" name="name" class="form-control" />
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">CPF <b class="text-red">*</b></label>
                                                    <input type="text" name="cpf" class="form-control" />
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Telefone de contato <b class="text-red">*</b></label>
                                                    <input type="text" name="phone" class="form-control" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-12 mr-t-10 text-right">
                                                    <button class="btn btn-primary btn-sm fs-14" type="submit">
                                                        Salvar alterações
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="status-financeiro formulario mr-t-20 bg-white p-4 border-radius-3">
                                        <h6 class="mr-b-10 mr-t-0">
                                            <i class="icone-dollar mr-r-5"></i>
                                            Status da conta
                                        </h6>

                                        <div class="well_plano_atual well-trial well-info text-center mr-b-5">
                                            <div class="lead">
                                                Plano atual: <b class="text-dark">Autônomo</b>
                                            </div>

                                            <span class="label label-success label-lead">
                                                Sua licença expira em <b>31/12/2018</b>
                                            </span>

                                            <p>
                                                Sua conta será desativada após o período de avaliação.<br>
                                                Para continuar usando o GerentePRO, escolha um plano abaixo.
                                            </p>
                                        </div>
                                    </div>

                                    <div class="status-financeiro formulario mr-t-10 bg-white p-4 border-radius-3">
                                        <h6 class="mr-b-10 mr-t-0">
                                            <i class="icone-dollar mr-r-5"></i>
                                            Configurações de cobrança
                                        </h6>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Forma de pagamento</label>
                                                    <select name="" id="" class="form-control selectpicker">
                                                        <option value="">Boleto Bancário</option>
                                                        <option value="">Cartão de Crédito</option>
                                                        <option value="">Depósito / Transferência</option>
                                                        <option value="">Débito automático</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Período</label>
                                                    <select name="" id="" class="form-control selectpicker">
                                                        <option value="">Mensal</option>
                                                        <option value="">Anual</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12 mr-t-10 text-right">
                                                <button type="submit" class="btn btn-primary btn-sm fs-14">Salvar configurações</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="detalhes mr-t-10 bg-white p-3 border-radius-3">
                                <div class="row mr-t-20">
                                    <div class="col-md-12">
                                        <table cellpadding="0" cellspacing="0" class="pricing-table act-pricing-table five-plans-table" width="100%">

                                            <tr class="pricing-table-header-tab">
                                                <td></td>
                                                <td></td>
                                                <td class="featured-tab condensed pricing-table-featured-plan-highlight-cell">Plano atual</td>
                                                <td></td>
                                                <td></td>
                                            </tr>

                                            <tr class="pricing-table-header">
                                                <td style="text-align">Escolha seu plano</td>
                                                <td>Iniciante</td>
                                                <td class="pricing-table-column-basic pricing-table-featured-plan-highlight-cell pricing-table-highlight-cell">Autônomo</td>
                                                <td>Profissional</td>
                                                <td>Empresa</td>
                                            </tr>

                                            <tr>
                                                <td></td>
                                                <td>
                                                    <div style="padding-top:10px; display:block;">
                                                        <!--<span class="pricing-table-currency condensed">R$</span>-->
                                                        <span class="pricing-table-price preco_gratis">Grátis</span>
                                                        <span class="pricing-table-cents condensed"></span>
                                                        <span class="pricing-table-period condensed"></span>
                                                        <span class="pricing-table-restriction condensed"><p>Faturado anualmente ou</p><p> R$29 por mês</p></span>
                                                        <div class="pricing-table-button">
                                                            <a style="margin-top:20px;" class="btn btn-select-plan-plus btn-primary btn-select-plan" href="#">Assine Já!</a>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="pricing-table-featured-plan-highlight-cell pricing-table-highlight-cell">
                                                    <div style="padding-top:10px;">
                                                        <span class="pricing-table-currency price_current">R$</span>
                                                        <span class="pricing-table-price price_current">29</span>
                                                        <span class="pricing-table-cents price_current">,90</span>
                                                        <span class="pricing-table-period price_current">Por Mês</span>
                                                        <span class="pricing-table-restriction price_current"><p>Faturado anualmente ou</p><p> R$29 por mês</p></span>
                                                        <div class="pricing-table-button">
                                                            <a class="btn btn-select-plan-plus btn-default btn-select-plan disabled" href="#">Selecionado</a>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="padding-top:10px;">
                                                        <span class="pricing-table-currency condensed">R$</span>
                                                        <span class="pricing-table-price condensed">79</span>
                                                        <span class="pricing-table-cents condensed">,90</span>
                                                        <span class="pricing-table-period condensed">Por Mês</span>
                                                        <span class="pricing-table-restriction condensed"><p>Faturado anualmente ou</p><p> R$29 por mês</p></span>
                                                        <div class="pricing-table-button">
                                                            <a class="btn btn-select-plan-plus btn-primary btn-select-plan" href="#">Assine Já!</a>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="padding-top:10px;">
                                                        <span class="pricing-table-currency condensed">R$</span>
                                                        <span class="pricing-table-price condensed">149</span>
                                                        <span class="pricing-table-cents condensed">,90</span>
                                                        <span class="pricing-table-period condensed">Por Mês</span>
                                                        <span class="pricing-table-restriction condensed"><p>Faturado anualmente ou</p><p> R$29 por mês</p></span>
                                                        <div class="pricing-table-button">
                                                            <a class="btn btn-select-plan-plus btn-primary btn-select-plan" href="#">Assine Já!</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr class="pricing-table-items">
                                                <td>Instalação do Sistema</td>
                                                <td>On Demand</td>
                                                <td class="pricing-table-featured-plan-highlight-cell pricing-table-highlight-cell">
                                                    On Demand
                                                </td>
                                                <td>On Demand</td>
                                                <td>Servidor Próprio</td>
                                            </tr>

                                            <tr class="pricing-table-items">
                                                <td>Limite Máximo de Usuários</td>
                                                <td><b>1</b> usuário</td>
                                                <td class="pricing-table-featured-plan-highlight-cell pricing-table-highlight-cell">
                                                    <b>5</b> usuários
                                                </td>
                                                <td><b>20</b> usuários</td>
                                                <td><b>50</b> usuários</td>
                                            </tr>

                                            <tr class="pricing-table-items">
                                                <td>Boletos e Faturas</td>
                                                <td><b>100</b> por mês</td>
                                                <td class="pricing-table-featured-plan-highlight-cell pricing-table-highlight-cell">
                                                    <b>500</b> por mês
                                                </td>
                                                <td><b>2000</b> por mês</td>
                                                <td><b>5000</b> por mês</td>
                                            </tr>

                                            <tr class="pricing-table-items">
                                                <td>Configuração de Planos de Assinatura</td>
                                                <td><i class="icone-ok-6"></i></td>
                                                <td class="pricing-table-featured-plan-highlight-cell pricing-table-highlight-cell">
                                                    <i class="icone-ok-6"></i>
                                                </td>
                                                <td><i class="icone-ok-6"></i></td>
                                                <td><i class="icone-ok-6"></i></td>
                                            </tr>

                                            <tr class="pricing-table-items">
                                                <td>Painel de Cliente Personalizado</td>
                                                <td></td>
                                                <td class="pricing-table-featured-plan-highlight-cell pricing-table-highlight-cell">
                                                    <i class="icone-ok-6"></i>
                                                </td>
                                                <td><i class="icone-ok-6"></i></td>
                                                <td><i class="icone-ok-6"></i></td>
                                            </tr>

                                            <tr class="pricing-table-items">
                                                <td>Carrinho de Compras / One Step Checkout</td>
                                                <td><i class="icone-ok-6"></i></td>
                                                <td class="pricing-table-featured-plan-highlight-cell pricing-table-highlight-cell">
                                                    <i class="icone-ok-6"></i>
                                                </td>
                                                <td><i class="icone-ok-6"></i></td>
                                                <td><i class="icone-ok-6"></i></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="tab-pane" id="historico" aria-expanded="true">
                            <!-- E-mails -->
                            <div class="faturas mr-t-20 bg-white p-3 border-radius-3">
                                <h6 class="mr-b-20 mr-t-0">
                                    <i class="fa fa-calendar mr-r-5"></i>
                                    Histórico de assinatura

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
                                        <th>Data</th>
                                        <th>Descrição</th>
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
                    </div>
                    <!--./tab-content -->
                </div>
            </div>
        </div>
    </div>
@endsection