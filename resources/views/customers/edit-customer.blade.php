@extends('layouts.sistema')
@section('content')
    <div class="row page-title clearfix">
        <div class="page-title-left">
            <h6 class="page-title-heading mr-0 mr-r-5">Alteração de Clientes</h6>
        </div>
        <!-- /.page-title-left -->
        <div class="page-title-right d-none d-sm-inline-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="./index.html">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Search Results</li>
            </ol>
        </div>
        <!-- /.page-title-right -->
    </div>
    <div class="widget-list ">
        <div class="row">
            <div class="content-with-sidebar">
                <div class="widget-bg border-radius-3 p-3">
                    <form class="formulario" action="{{route('customers.edit.submit', $customer->uuid)}}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="box-cadastro">
                            <h6 class="mr-b-20 mr-t-0">
                                <i class="icone-user-1"></i>
                                Dados do cliente
                            </h6>
                            <div class="box-detalhes">
                                <div class="row">
                                    <input type="hidden" value="fisica" id="type" name="type" />
                                    <input type="hidden" value="{{ AccountId() }}" name="account_id" />
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                            <label for="label_razao_nome">Nome Completo</label>
                                            <input type="text" class="form-control" name="name" value="{{$customer->name or old('name') }}" id="label_razao_nome" required>
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
                                            <input type="text" class="form-control formatCPF" name="cpf_cnpj" value="{{$customer->cpf_cnpj or old('cpf_cnpj') }}" placeholder="" id="label_cpf_cnpj" required>
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
                                            <input type="email" class="form-control" value="{{$customer->email or old('email') }}" name="email" id="label_email" required>
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
                                            <input type="text" class="form-control formatTEL" value="{{$customer->phone or old('phone') }}" name="phone" placeholder="" id="label_tel" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="label_cel">Celular</label>
                                            <input type="text" class="form-control formatCEL" value="{{$customer->mobile or old('mobile') }}" name="mobile" placeholder="" id="label_cel" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="label_rg">RG</label>
                                                <input type="text" class="form-control" name="rg" value="{{$customer->rg or old('rg') }}" id="label_rg">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="label_nascimento">Data de Nascimento</label>
                                            <div class="input-group input-has-value">
                                                <input type="text" name="birthdate" value="{{$customer->birthdate or old('birthdate') }}" class="form-control" id="datepicker">
                                                <span class="input-group-addon">
                                                   <i class="icone-calendar"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="label_uf">Sexo</label>
                                            <select class="form-control" name="genre" id="label_uf" required>
                                                <option value=""></option>
                                                <option value="M" @if($customer->genre == "M" or old('genre') == "M")selected="selected" @endif >Masculino</option>
                                                <option value="F" @if($customer->genre == "F" or old('genre') == "M")selected="selected" @endif >Feminino</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 pd-b-20">
                                        <div class="form-group">
                                            <label for="label_obs">Observações</label>
                                            <textarea class="form-control" name="obs" id="label_obs" rows="2">{{$customer->obs or old('obs')}}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-cadastro">
                            <header>
                                <h6 class="mr-b-20 mr-t-0">
                                    <i class="icone-address-book"></i>
                                    Endereço
                                </h6>
                            </header>
                            <div class="box-detalhes">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="label_cep">CEP</label>
                                            <input type="text" class="form-control formatCEP buscaCEP" name="zipcode" value="{{$customer->address->zipcode or old('zipcode') }}" id="label_cep" required>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="form-group">
                                            <label for="label_logradouro">Logradouro</label>
                                            <input type="text" class="form-control" name="address" value="{{$customer->address->address or old('address') }}" id="label_logradouro" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="label_numero">Número</label>
                                            <input type="text" class="form-control" name="number" value="{{$customer->address->number or old('number') }}" id="label_numero">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="label_uf">UF</label>
                                            <select class="form-control" name="uf" id="label_uf" required>
                                                <option value=""></option>
                                                <option value="AC" @if($customer->address != null && $customer->address->uf == "AC" or old('uf') == "AC")selected="selected" @endif>AC</option>
                                                <option value="AL" @if($customer->address != null && $customer->address->uf == "AL" or old('uf') == "AL")selected="selected" @endif>AL</option>
                                                <option value="AM" @if($customer->address != null && $customer->address->uf == "AM" or old('uf') == "AM")selected="selected" @endif>AM</option>
                                                <option value="AP" @if($customer->address != null && $customer->address->uf == "AP" or old('uf') == "AP")selected="selected" @endif>AP</option>
                                                <option value="BA" @if($customer->address != null && $customer->address->uf == "BA" or old('uf') == "BA")selected="selected" @endif>BA</option>
                                                <option value="CE" @if($customer->address != null && $customer->address->uf == "CE" or old('uf') == "CE")selected="selected" @endif>CE</option>
                                                <option value="DF" @if($customer->address != null && $customer->address->uf == "DF" or old('uf') == "DF")selected="selected" @endif>DF</option>
                                                <option value="ES" @if($customer->address != null && $customer->address->uf == "ES" or old('uf') == "ES")selected="selected" @endif>ES</option>
                                                <option value="GO" @if($customer->address != null && $customer->address->uf == "GO" or old('uf') == "GO")selected="selected" @endif>GO</option>
                                                <option value="MA" @if($customer->address != null && $customer->address->uf == "MA" or old('uf') == "MA")selected="selected" @endif>MA</option>
                                                <option value="MG" @if($customer->address != null && $customer->address->uf == "MG" or old('uf') == "MG")selected="selected" @endif>MG</option>
                                                <option value="MS" @if($customer->address != null && $customer->address->uf == "MS" or old('uf') == "MS")selected="selected" @endif>MS</option>
                                                <option value="MT" @if($customer->address != null && $customer->address->uf == "MT" or old('uf') == "MT")selected="selected" @endif>MT</option>
                                                <option value="PA" @if($customer->address != null && $customer->address->uf == "PA" or old('uf') == "PA")selected="selected" @endif>PA</option>
                                                <option value="PB" @if($customer->address != null && $customer->address->uf == "PB" or old('uf') == "PB")selected="selected" @endif>PB</option>
                                                <option value="PE" @if($customer->address != null && $customer->address->uf == "PE" or old('uf') == "PE")selected="selected" @endif>PE</option>
                                                <option value="PI" @if($customer->address != null && $customer->address->uf == "PI" or old('uf') == "PI")selected="selected" @endif>PI</option>
                                                <option value="PR" @if($customer->address != null && $customer->address->uf == "PR" or old('uf') == "PR")selected="selected" @endif>PR</option>
                                                <option value="RJ" @if($customer->address != null && $customer->address->uf == "RJ" or old('uf') == "RJ")selected="selected" @endif>RJ</option>
                                                <option value="RN" @if($customer->address != null && $customer->address->uf == "RN" or old('uf') == "RN")selected="selected" @endif>RN</option>
                                                <option value="RS" @if($customer->address != null && $customer->address->uf == "RS" or old('uf') == "RS")selected="selected" @endif>RS</option>
                                                <option value="RO" @if($customer->address != null && $customer->address->uf == "RO" or old('uf') == "RO")selected="selected" @endif>RO</option>
                                                <option value="RR" @if($customer->address != null && $customer->address->uf == "RR" or old('uf') == "RR")selected="selected" @endif>RR</option>
                                                <option value="SC" @if($customer->address != null && $customer->address->uf == "SC" or old('uf') == "SC")selected="selected" @endif>SC</option>
                                                <option value="SE" @if($customer->address != null && $customer->address->uf == "SE" or old('uf') == "SE")selected="selected" @endif>SE</option>
                                                <option value="SP" @if($customer->address != null && $customer->address->uf == "SP" or old('uf') == "SP")selected="selected" @endif>SP</option>
                                                <option value="TO" @if($customer->address != null && $customer->address->uf == "TO" or old('uf') == "TO")selected="selected" @endif>TO</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="label_cidade">Cidade</label>
                                            <input type="text" class="form-control" name="city" value="{{$customer->address->city or old('city') }}" id="label_cidade" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="label_bairro">Bairro</label>
                                            <input type="text" class="form-control" name="district" value="{{$customer->address->district or old('district') }}" id="label_bairro" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="label_complemento">Complemento</label>
                                            <input type="text" class="form-control" name="additional" value="{{$customer->address->additional or old('additional') }}" id="label_complemento">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 20px;">
                            <div class="col-md-6">
                                <div class="carregando" style="display: none;">
                                    <img src="{{ asset('images/ajax-loader2.gif') }}" />
                                    Aguarde, Carregando...
                                </div>
                            </div>
                            <div class="col-md-6 text-right">
                                <a type="button" class="btn btn-default" href="{{ route('customers.index') }}" data-dismiss="modal">Cancelar</a>
                                <button type="submit" class="btn btn-primary icone-ok">
                                    Alterar Cadastro
                                </button>
                            </div>
                        </div>
                        {{ csrf_field() }}
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