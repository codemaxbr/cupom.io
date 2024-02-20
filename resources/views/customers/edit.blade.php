@extends('layouts.sistema')
@section('content')
    <div class="col-md-9 content" role="main">
        <form id="formEdit_clientes" action="{{ route('customers.submit.edit', $customer->uuid) }}" method="post">

            <div class="box-cadastro">
                <header>
                    <h3 class="title-box">
                        Dados do cliente
                    </h3>
                </header>

                <div class="box-detalhes">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="btn-group  activation-toggle" role="group" aria-label="...">
                                    <button type="button" class="btn pessoa_fisica btn-default {{ ($customer->type == "fisica") ? "active" : ""}}">Pessoa Física</button>
                                    <button type="button" class="btn pessoa_juridica btn-default {{ ($customer->type == "juridica") ? "active" : ""}}">Pessoa Jurídica</button>
                                </div>

                                <input type="hidden" value="{{ $customer->type }}" id="type" name="type" />
                                <input type="hidden" value="{{ session('account')->id }}" name="account_id" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="label_razao_nome">Nome Completo</label>
                                <input type="text" class="form-control" name="name" value="{{ $customer->name }}" id="label_razao_nome" required>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        {{ $errors->first('name') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group{{ $errors->has('cpf_cnpj') ? ' has-error' : '' }}">
                                <label for="label_cpf_cnpj">CPF</label>
                                <input type="text" class="form-control formatCPF" name="cpf_cnpj" value="{{ $customer->cpf_cnpj }}" placeholder="" id="label_cpf_cnpj" required>
                                @if ($errors->has('cpf_cnpj'))
                                    <span class="help-block">
                                        {{ $errors->first('cpf_cnpj') }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="label_email">E-mail</label>
                                <input type="email" class="form-control" value="{{ $customer->email }}" name="email" id="label_email" required>
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
                                <input type="text" class="form-control formatTEL" value="{{ $customer->phone }}" name="phone" placeholder="" id="label_tel" required>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="label_cel">Celular</label>
                                <input type="text" class="form-control formatCEL" value="{{ $customer->mobile }}" name="mobile" placeholder="" id="label_cel" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="label_email_nfe">E-mail para envio da NF-e</label>
                                <input type="text" class="form-control" name="email_nfe" value="{{ $customer->email_nfe }}" placeholder="" id="label_email_nfe">
                            </div>
                        </div>

                        <div class="div_juridica" style="display: none;">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="label_inscricao_municipal">Inscrição Municipal</label>
                                    <input type="text" class="form-control" name="ins_municipal" value="{{ $customer->ins_municipal }}" id="label_inscricao_municipal">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="label_inscricao_estadual">Inscrição Estadual</label>
                                    <input type="text" class="form-control" name="ins_estadual" value="{{ $customer->ins_estadual }}" id="label_inscricao_estadual">
                                </div>
                            </div>
                        </div>

                        <div class="div_fisica">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="label_rg">RG</label>
                                    <input type="text" class="form-control" name="rg" value="{{$customer->rg }}" id="label_rg">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="label_nascimento">Data de Nascimento</label>
                                    <div class="input-group input-group-sm date">
                                        <input type="text" name="birthdate" value="{{ dateFormat($customer->birthdate, 'd/m/Y') }}" class="form-control" id="datepicker">
                                        <span class="input-group-btn">
                                            <a class="btn btn-default btn-flat" class="datepicker">
                                                <i class="icone-calendar"></i>
                                            </a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="box-cadastro">
                <header>
                    <h3 class="title-box">
                        Endereços
                    </h3>
                </header>

                <div class="box-detalhes">

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="label_cep">CEP</label>
                                <input type="text" class="form-control formatCEP buscaCEP" name="zipcode" value="{{ $customer->zipcode }}" id="label_cep" required>
                            </div>
                        </div>

                        <div class="col-md-7">
                            <div class="form-group">
                                <label for="label_logradouro">Logradouro</label>
                                <input type="text" class="form-control" name="address" value="{{ $customer->address }}" id="label_logradouro" required>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="label_numero">Número</label>
                                <input type="text" class="form-control" name="number" value="{{ $customer->number }}" id="label_numero">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="label_uf">UF</label>
                                <select class="form-control" name="uf" id="label_uf" required>
                                    <option value=""></option>
                                    <option value="AC" {{ ($customer->uf == "AC") ? "selected" : ""}}>AC</option>
                                    <option value="AL" {{ ($customer->uf == "AL") ? "selected" : ""}}>AL</option>
                                    <option value="AM" {{ ($customer->uf == "AM") ? "selected" : ""}}>AM</option>
                                    <option value="AP" {{ ($customer->uf == "AP") ? "selected" : ""}}>AP</option>
                                    <option value="BA" {{ ($customer->uf == "BA") ? "selected" : ""}}>BA</option>
                                    <option value="CE" {{ ($customer->uf == "CE") ? "selected" : ""}}>CE</option>
                                    <option value="DF" {{ ($customer->uf == "DF") ? "selected" : ""}}>DF</option>
                                    <option value="ES" {{ ($customer->uf == "ES") ? "selected" : ""}}>ES</option>
                                    <option value="GO" {{ ($customer->uf == "GO") ? "selected" : ""}}>GO</option>
                                    <option value="MA" {{ ($customer->uf == "MA") ? "selected" : ""}}>MA</option>
                                    <option value="MG" {{ ($customer->uf == "MG") ? "selected" : ""}}>MG</option>
                                    <option value="MS" {{ ($customer->uf == "MS") ? "selected" : ""}}>MS</option>
                                    <option value="MT" {{ ($customer->uf == "MT") ? "selected" : ""}}>MT</option>
                                    <option value="PA" {{ ($customer->uf == "PA") ? "selected" : ""}}>PA</option>
                                    <option value="PB" {{ ($customer->uf == "PB") ? "selected" : ""}}>PB</option>
                                    <option value="PE" {{ ($customer->uf == "PE") ? "selected" : ""}}>PE</option>
                                    <option value="PI" {{ ($customer->uf == "PI") ? "selected" : ""}}>PI</option>
                                    <option value="PR" {{ ($customer->uf == "PR") ? "selected" : ""}}>PR</option>
                                    <option value="RJ" {{ ($customer->uf == "RJ") ? "selected" : ""}}>RJ</option>
                                    <option value="RN" {{ ($customer->uf == "RN") ? "selected" : ""}}>RN</option>
                                    <option value="RS" {{ ($customer->uf == "RS") ? "selected" : ""}}>RS</option>
                                    <option value="RO" {{ ($customer->uf == "RO") ? "selected" : ""}}>RO</option>
                                    <option value="RR" {{ ($customer->uf == "RR") ? "selected" : ""}}>RR</option>
                                    <option value="SC" {{ ($customer->uf == "SC") ? "selected" : ""}}>SC</option>
                                    <option value="SE" {{ ($customer->uf == "SE") ? "selected" : ""}}>SE</option>
                                    <option value="SP" {{ ($customer->uf == "SP") ? "selected" : ""}}>SP</option>
                                    <option value="TO" {{ ($customer->uf == "TO") ? "selected" : ""}}>TO</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="label_cidade">Cidade</label>
                                <input type="text" class="form-control" name="city" value="{{ $customer->city }}" id="label_cidade" required>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="label_bairro">Bairro</label>
                                <input type="text" class="form-control" name="district" value="{{ $customer->district }}" id="label_bairro" required>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="label_complemento">Complemento</label>
                                <input type="text" class="form-control" name="additional" value="{{ $customer->additional }}" id="label_complemento">
                            </div>
                        </div>
                    </div>
                </div>

                <a class="btn btn-info">Incluir</a>
            </div>

            <div class="row" style="margin-top: 20px;">
                <div class="col-md-6">
                    <div class="carregando" style="display: none;">
                        <img src="{{ asset('images/ajax-loader2.gif') }}" />
                        Aguarde, Carregando...
                    </div>
                </div>
                <div class="col-md-6 text-right">
                    <a type="button" class="btn btn-default" href="{{ route('customers') }}" data-dismiss="modal">Cancelar</a>

                    <a class="btn btn-primary" rel="submitEdit_clientes">
                        <i class="icone-ok"></i>
                        Finalizar Cadastro
                    </a>
                </div>
            </div>

            {{ csrf_field() }}
        </form>
    </div>

    <aside class="sidebar col-md-3" role="complementary">

        <section class="sidebox">
            <h1 class="sidebox-title ico-question">Ajuda</h1>
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

    <!-- Datepicker -->
    <script src="{{ asset('plugins/datepicker/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('plugins/datepicker/locales/bootstrap-datepicker.pt-BR.js') }}"></script>

    <!-- InputMask -->
    <script src="{{ asset('plugins/input-mask/jquery.inputmask.js') }}"></script>
    <script src="{{ asset('plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
    <script src="{{ asset('plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>

    <script type="text/javascript" src="{{ asset('js/functions/clientes.js') }}"></script>

@endsection