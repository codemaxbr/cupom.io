@extends('layouts.sistema')
@section('content')
    <div class="row page-title clearfix">
        <div class="page-title-left">
            <h6 class="page-title-heading mr-0 mr-r-5">Novo Fornecedor</h6>
        </div>
        <!-- /.page-title-left -->
        <div class="page-title-right d-none d-sm-inline-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">Dashboard</a>
                </li>

                <li class="breadcrumb-item">
                    <a href="{{ route('providers.index') }}">Fornecedores</a>
                </li>
                <li class="breadcrumb-item active">Novo</li>
            </ol>
        </div>
        <!-- /.page-title-right -->
    </div>
    <div class="widget-list ">
        <div class="row">
            <div class="content-with-sidebar">
                <div class="widget-bg border-radius-3 p-3">
                    <form class="formulario" action="{{ route('providers.store') }}" method="post">
                        <div class="box-cadastro">
                            <h6 class="mr-b-20 mr-t-0">
                                <i class="icone-user-1"></i>
                                Dados de contato
                            </h6>

                            <div class="box-detalhes">
                                <div class="row mr-b-10">
                                    <div class="col-md-12">

                                        <div class="form-group">
                                            <div class="btn-group  activation-toggle" role="group" aria-label="...">
                                                <button type="button" class="btn btn-sm fs-15 pessoa_fisica btn-default active">Pessoa Física</button>
                                                <button type="button" class="btn btn-sm fs-15 pessoa_juridica btn-default">Pessoa Jurídica</button>
                                            </div>

                                            <input type="hidden" value="fisica" id="type" name="type" />
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                            <label for="label_razao_nome">Nome Completo</label>
                                            <input type="text" class="form-control" name="name" value="{{ old('name') }}" id="label_razao_nome" required>
                                            @if ($errors->has('name'))
                                                <span class="help-block">
                                                    {{ $errors->first('name') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group{{ $errors->has('fantasia') ? ' has-error' : '' }}">
                                            <label for="label_fantasia">Fantasia (opcional)</label>
                                            <input type="text" class="form-control" name="fantasia" value="{{ old('fantasia') }}" placeholder="" id="label_fantasia">
                                            @if ($errors->has('fantasia'))
                                                <span class="help-block">
                                                    {{ $errors->first('fantasia') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="label_id">ID</label>
                                            <input type="text" class="form-control disabled" value="" disabled="disabled">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                            <label for="label_email">E-mail</label>
                                            <input type="email" class="form-control" value="{{ old('email') }}" name="email" id="label_email" required>
                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                                {{ $errors->first('email') }}
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="label_tel">Telefone</label>
                                            <input type="text" class="form-control formatTEL" value="{{ old('phone') }}" name="phone" placeholder="" id="label_tel" required>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="label_cel">Celular (opcional)</label>
                                            <input type="text" class="form-control formatCEL" value="{{ old('mobile') }}" name="mobile" placeholder="" id="label_cel">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group{{ $errors->has('cpf_cnpj') ? ' has-error' : '' }}">
                                            <label for="label_cpf_cnpj">CPF</label>
                                            <input type="text" class="form-control formatCPF" name="cpf_cnpj" value="{{ old('cpf_cnpj') }}" placeholder="" id="label_cpf_cnpj" required>
                                            @if ($errors->has('cpf_cnpj'))
                                                <span class="help-block">
                                                    {{ $errors->first('cpf_cnpj') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="div_juridica col-md-8" style="display: none;">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="label_inscricao_municipal">Inscrição Municipal</label>
                                                    <input type="text" class="form-control" name="insc_municipal" value="{{ old('insc_municipal') }}" id="label_inscricao_municipal">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="label_inscricao_estadual">Inscrição Estadual</label>
                                                    <input type="text" class="form-control" name="insc_estadual" value="{{ old('insc_estadual') }}" id="label_inscricao_estadual">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="div_fisica col-md-8">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="label_nascimento">Nascimento</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="icone-calendar mr-l-5"></i>
                                                        </span>
                                                        <input class="form-control datepicker" name="birthdate" placeholder="dd/mm/aaaa" type="text">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="box-cadastro">

                            <h6 class="mr-b-20 mr-t-20">
                                <i class="icone-location"></i>
                                Endereço
                            </h6>

                            <div class="box-detalhes">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="label_cep">CEP</label>
                                            <input type="text" class="form-control formatCEP buscaCEP" name="zipcode" value="{{ old('zipcode') }}" id="label_cep" required>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="form-group">
                                            <label for="label_logradouro">Logradouro</label>
                                            <input type="text" class="form-control" name="address" value="{{ old('address') }}" id="label_logradouro" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="label_numero">Número</label>
                                            <input type="text" class="form-control" name="number" value="{{ old('number') }}" id="label_numero" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="label_uf">UF</label>
                                            <select class="selectpicker form-control" name="uf" id="label_uf" required>
                                                <option value="">Selecione</option>
                                                <option value="AC" @if(old('uf') == "AC") selected @endif>AC</option>
                                                <option value="AL" @if(old('uf') == "AL") selected @endif>AL</option>
                                                <option value="AM" @if(old('uf') == "AM") selected @endif>AM</option>
                                                <option value="AP" @if(old('uf') == "AP") selected @endif>AP</option>
                                                <option value="BA" @if(old('uf') == "BA") selected @endif>BA</option>
                                                <option value="CE" @if(old('uf') == "CE") selected @endif>CE</option>
                                                <option value="DF" @if(old('uf') == "DF") selected @endif>DF</option>
                                                <option value="ES" @if(old('uf') == "ES") selected @endif>ES</option>
                                                <option value="GO" @if(old('uf') == "GO") selected @endif>GO</option>
                                                <option value="MA" @if(old('uf') == "MA") selected @endif>MA</option>
                                                <option value="MG" @if(old('uf') == "MG") selected @endif>MG</option>
                                                <option value="MS" @if(old('uf') == "MS") selected @endif>MS</option>
                                                <option value="MT" @if(old('uf') == "MT") selected @endif>MT</option>
                                                <option value="PA" @if(old('uf') == "PA") selected @endif>PA</option>
                                                <option value="PB" @if(old('uf') == "PB") selected @endif>PB</option>
                                                <option value="PE" @if(old('uf') == "PE") selected @endif>PE</option>
                                                <option value="PI" @if(old('uf') == "PI") selected @endif>PI</option>
                                                <option value="PR" @if(old('uf') == "PR") selected @endif>PR</option>
                                                <option value="RJ" @if(old('uf') == "RJ") selected @endif>RJ</option>
                                                <option value="RN" @if(old('uf') == "RN") selected @endif>RN</option>
                                                <option value="RS" @if(old('uf') == "RS") selected @endif>RS</option>
                                                <option value="RO" @if(old('uf') == "RO") selected @endif>RO</option>
                                                <option value="RR" @if(old('uf') == "RR") selected @endif>RR</option>
                                                <option value="SC" @if(old('uf') == "SC") selected @endif>SC</option>
                                                <option value="SE" @if(old('uf') == "SE") selected @endif>SE</option>
                                                <option value="SP" @if(old('uf') == "SP") selected @endif>SP</option>
                                                <option value="TO" @if(old('uf') == "TO") selected @endif>TO</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="label_cidade">Cidade</label>
                                            <input type="text" class="form-control" name="city" value="{{ old('city') }}" id="label_cidade" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="label_bairro">Bairro</label>
                                            <input type="text" class="form-control" name="district" value="{{ old('district') }}" id="label_bairro" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="label_complemento">Complemento (opcional)</label>
                                            <input type="text" class="form-control" name="additional" value="{{ old('additional') }}" id="label_complemento">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{ csrf_field() }}

                        <div class="row" style="margin-top: 20px;">
                            <div class="col-md-12 text-right">
                                <a href="{{ route('providers.index') }}" class="btn btn-sm btn-default fs-14 mr-r-5 text-dark">
                                    <i class="fa fa-arrow-left mr-r-5"></i>
                                    Voltar para lista de fornecedores
                                </a>

                                <button type="submit" class="btn btn-sm btn-primary fs-14">
                                    <i class="icone-ok"></i>
                                    Salvar Fornecedor
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="actions-sidebar">
                <!-- Endereços -->
                <div class="widget-bg widget-notes  border-radius-3">
                    <div class="widget-body profile-user-description p-3">
                        <h6 class="mr-t-0">
                            <i class="icone-info-circled-1"></i>
                            Ajuda
                        </h6>
                        <div class="contact-details-cell text-left mr-t-10">
                            <p class="mr-b-0 w-100">
                                <small class="heading-font-family fw-500">Campos Obrigatórios</small><br />
                                Fique atento aos dados CPF, CNPJ, Data de Nascimento e E-mail. Estes dados são obrigatórios para evitar qualquer tipo de problema com cadastros inválidos ou SPAM.
                            </p>
                        </div>
                        <div class="contact-details-cell text-left mr-t-10">
                            <p class="mr-b-0 w-100">
                                <small class="heading-font-family fw-500">E-mail Autenticado</small><br />
                                Todas as operações com interação do cliente será enviado uma notificação por e-mail para acompanhamento e validação.
                                </br></br>
                                Se o e-mail digitado for inválido, o cadastro será desativado em 48h.
                            </p>
                        </div>
                    </div>
                </div>
                <!-- ./ Endereços -->
            </div>
        </div>
    </div>

    <!-- Datepicker -->
    <script src="{{ asset('plugins/datepicker/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('plugins/datepicker/locales/bootstrap-datepicker.pt-BR.js') }}"></script>

    <!-- InputMask -->
    <script src="{{ asset('plugins/input-mask/jquery.inputmask.js') }}"></script>
    <script src="{{ asset('plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
    <script src="{{ asset('plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>

    <script type="text/javascript" src="{{ asset('js/functions/clientes.js') }}"></script>

@endsection