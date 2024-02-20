@extends('layouts.auth-front')
@section('title', 'Assinatura - Login')

@section('content')

    <div id="carrinho">
        <div class="container">
            <div class="row">
                <div class="col-xs-3 col-md-12">
                    <div class="row">
                        <ol class="col-xs-11">
                            <li>
                            <span class="icones-header">
                                <!--<i class="fa fa-shopping-cart"></i>-->
                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="19px" height="19px" viewBox="0 0 80 80" enable-background="new 0 0 80 80" xml:space="preserve">
                                <circle fill-rule="evenodd" clip-rule="evenodd" fill="#469AFF" cx="27.6" cy="69.6" r="7.4"></circle>
                                <circle fill-rule="evenodd" clip-rule="evenodd" fill="#469AFF" cx="62.1" cy="69.6" r="7.4"></circle>
                                <path fill-rule="evenodd" clip-rule="evenodd" fill="#469AFF" d="M77.8,12.9H17.7l-2.4-8.3C15,3.7,14.5,3,13.2,3H2
                                    C1.1,3,0.4,3.7,0.4,4.5v1.9c0,0.9,0.7,1.5,1.5,1.5h9.3l13.8,47.8c0.3,1,0.9,1.4,1.8,1.5c0.1,0,0.4,0,0.4,0H63c0.9,0,1.5-0.7,1.5-1.5
                                    v-1.8c0-0.9-0.7-1.5-1.5-1.5h-34l-2.9-9.9h42.7c0.9,0,1.8-0.7,2-1.5c0,0,8.3-25.9,8.4-26.2c0.1-0.3,0.2-0.7-0.2-1.3
                                    C78.8,13.1,78.3,12.9,77.8,12.9z"></path>
                                </svg>
                            </span>
                                <p>PRODUTO</p>
                            </li>

                            <li>
                            <span class="icones-header">
                                <!--<i class="fas fa-dollar-sign"></i>-->
                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="17px" height="17px" viewBox="0 0 80 80" enable-background="new 0 0 80 80" xml:space="preserve">
                                <path fill="#23BA37" d="M42.1,79.8c0.8,0,1.5-0.7,1.5-1.5c0,0,0,0.1,0,0v-6.8c5.5-0.5,9.8-2.1,13-4.5c0,0,0,0,0.1,0
                                    c1.9-1.5,3.4-3.2,4.5-5.1c1.5-2.7,2.3-5.8,2.3-9.1c0-6.1-2.5-10-6.2-12.7c-3.8-2.8-8.8-4.3-13.6-5.6V18.7c2.2,0.5,4.4,1.2,6.5,2.3
                                    c1.5,0.8,3,1.7,4.4,2.9c0.1,0.1,0.7,0.7,1.4,0.7c0.7-0.1,1.1-0.7,1.1-0.7l4.1-5.4c0,0,0.1-0.1,0.1-0.2c0.2-0.2,0.5-0.7,0.4-1.1
                                    c-0.1-0.6-0.8-1.1-0.9-1.1c-1.3-1.1-2.6-2-4-2.9c0,0,0,0-0.1,0c-3.8-2.2-8.1-3.7-13-4.2c0,0,0-0.1,0-0.3V1.8c0,0,0,0,0,0
                                    c0-0.8-0.7-1.5-1.5-1.5h-4.4c-0.8,0-1.5,0.7-1.5,1.5c0,0,0,0,0,0v7c-9.7,0.8-16.6,6-18.6,13.1c-0.5,1.5-0.7,3.1-0.7,4.7
                                    c0,6.9,3.3,10.9,7.9,13.5c3.4,1.9,7.4,3.1,11.4,4.1V62c-0.8-0.1-1.5-0.3-2.2-0.5c-4.4-1.1-8.2-3.3-11-5.8c-1.1-1-2.5-1.3-3.4-0.1
                                    c-0.6,0.8-2.3,3.2-3.5,4.9c-0.7,0.9-0.6,2.1,0.1,2.8c4.8,4.4,11.4,7.6,20.1,8.3v6.8c0,0,0,0,0,0c0,0.8,0.7,1.5,1.5,1.5H42.1z
                                     M36.2,32.6c-4.9-1.5-8.3-3.3-8.3-6.9c0-3.4,2.3-6,6.1-7.1c0.7-0.2,1.4-0.4,2.2-0.5V32.6z M50,59.2c-1.4,1.4-3.5,2.4-6.5,2.8V46.1
                                    c5,1.6,8.9,3.6,8.9,7.7C52.4,55.7,51.7,57.7,50,59.2z"></path>
                                </svg>
                            </span>
                                <p>PREÇO</p>
                            </li>

                            <li>
                            <span class="icones-header">
                                <!--<i class="fa fa-star"></i>-->
                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="18px" height="18px" viewBox="0 0 80 80" enable-background="new 0 0 80 80" xml:space="preserve">
                                <path fill="#F5C300" d="M79.9,31.6c0,0.8-0.4,1.4-1,1.8L58.4,49.8l6.9,25.2l0.1,0.5c0,0.1,0,0.2,0,0.4c0,1.2-1,2.2-2.2,2.2
                                    c-0.4,0-0.9-0.1-1.2-0.4L40,63.2L17.9,77.7c-0.3,0.2-0.8,0.4-1.2,0.4c-1.2,0-2.2-1-2.2-2.2c0-0.1,0.1-0.7,0.2-0.8l6.9-25.3L1.1,33.4
                                    c-0.1-0.1-0.2-0.2-0.3-0.3c-0.4-0.4-0.6-0.9-0.6-1.5c0-1.2,1-2.2,2.2-2.2l26.3-1.2L38,3.5c0-0.1,0-0.1,0.1-0.2C38.4,2.5,39.2,2,40,2
                                    c0.9,0,1.6,0.5,2,1.3c0,0.1,0.1,0.1,0.1,0.2l9.4,24.7l26.2,1.2H78C79,29.5,79.9,30.5,79.9,31.6z"></path>
                                </svg>
                            </span>
                                <p>DESCRIÇÃO</p>
                            </li>
                        </ol>
                    </div>
                </div>
                <div class="col-xs-9 col-sm-12 produto-pai">
                    @foreach($cart as $item)
                    <div class="row produto">
                        <ol class="col-xs-11">
                            <li>
                                <h3 class="nome-produto">
                                    {{ $item->name }}
                                </h3>
                            </li>
                            <li class="preco-produto">
                                <h3>R$ {{ numFormat($item->price) }} <span>{{ $item->options->ciclo }}</span></h3>
                            </li>
                            <li class="promocao-produto">
                                <h3>
                                    {{ $item->options->months }} @if($item->options->months > 1) meses @else mês @endif de assinatura
                                    <span>{{ $item->options->term }}</span>
                                </h3>
                            </li>
                        </ol>
                        <div class="col-xs-1">
                            <a href="#" class="btn btn-white remove-item">
                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="18px" height="18px" viewBox="0 0 80 80" enable-background="new 0 0 80 80" xml:space="preserve">
                                    <g>
                                        <path fill-rule="evenodd" clip-rule="evenodd" fill="#333333" d="M71.3,13.2H53.2V2c0-1.1-0.9-2.1-2.1-2.1H28.9
                                            c-1.1,0-2.1,0.9-2.1,2.1v11.2H9c-1.1,0-2.1,0.9-2.1,2.1v2.5c0,1.1,0.9,2.1,2.1,2.1h62.3c1.1,0,2.1-0.9,2.1-2.1v-2.5
                                            C73.4,14.2,72.5,13.2,71.3,13.2z M46.8,11.2c0,1.1-0.9,2.1-2.1,2.1h-9.1c-1.1,0-2.1-0.9-2.1-2.1V8.7c0-1.1,0.9-2.1,2.1-2.1h9.1
                                            c1.1,0,2.1,0.9,2.1,2.1V11.2z"></path>
                                        <path fill-rule="evenodd" clip-rule="evenodd" fill="#333333" d="M58.6,26.5V69c0,1.1-0.9,2.1-2.1,2.1H54c-1.1,0-2.1-0.9-2.1-2.1
                                            V26.5h-8.5V69c0,1.1-0.9,2.1-2.1,2.1h-2.5c-1.1,0-2.1-0.9-2.1-2.1V26.5h-8.5V69c0,1.1-0.9,2.1-2.1,2.1h-2.5c-1.1,0-2.1-0.9-2.1-2.1
                                            V26.5h-6.1v0h-2.1v3.3h0v47.8c0,1.1,0.9,2.1,2.1,2.1h49c1.1,0,2.1-0.9,2.1-2.1v-51c0,0,0-0.1,0-0.1H58.6z"></path>
                                    </g>
                                </svg>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="auth">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-sm-push-7 col-md-4 col-md-offset-1 col-md-push-7">
                    <h2>JÁ TEM CADASTRO?</h2>
                    <p>
                        use seu acesso <strong>Folha Dirigida</strong><br />
                        Campos com asterisco (*) são obrigatórios.
                    </p>

                    <form action="{{ route('checkout.login') }}" class="box-login" method="post">
                        @csrf
                        <div class="form-group @if ($errors->has('email')) has-error @endif">
                            <label for="usuario">Usuário *</label>
                            <input type="text" name="email" id="usuario" value="{{ old('email') }}" class="form-control" placeholder="Endereço de E-mail" />
                            @if ($errors->has('email'))
                                <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group @if ($errors->has('password')) has-error @endif">
                            <label for="senha">Senha *</label>
                            <input type="password" id="senha" name="password" class="form-control" placeholder="Senha" />
                            @if ($errors->has('password'))
                                <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>

                        <a href="{{ route('password.request') }}" class="ls-login-forgot">Esqueci minha senha</a>

                        @if (session('status'))
                            <div class="alert alert-info">
                                <i class="icone-spin3 animate-spin"></i>
                                {{ session('status') }}
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success">
                                <i class="icone-spin3 animate-spin"></i>
                                {{ session('success') }}
                            </div>
                        @endif

                        <button type="submit" class="btn btn-primary mr-t-15">
                            FAZER LOGIN
                        </button>
                    </form>
                    <hr>
                </div>
                <span class="col-xs-12 col-md-1 col-md-push-1 borda"></span>

                <div class="col-xs-12 col-md-6 col-md-pull-6">
                    <form action="{{ route('checkout.register') }}" method="post">
                        @csrf
                        <h1>CRIAR MINHA CONTA</h1>
                        <p>
                            Para continuar, faça o seu cadastro na <strong>Folha Dirigida</strong><br />
                            Campos com asterisco (*) são obrigatórios.
                        </p>

                        <div class="form-group">
                            <label for="nome">Nome completo <b class="text-red">*</b></label>
                            <input type="text" name="name" id="nome" class="form-control" value="{{ old('name') }}" required placeholder="Nome e Sobrenome" />
                        </div>

                        <div class="form-group">
                            <label for="email">Endereço de E-mail <b class="text-red">*</b></label>
                            <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required placeholder="E-mail para login e cobrança" />
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cpf">CPF <b class="text-red">*</b></label>
                                    <input type="text" name="cpf" id="cpf" value="{{ old('cpf') }}" required class="form-control formatCPF" placeholder="000.000.000-00" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password">Senha <b class="text-red">*</b></label>
                                    <input type="password" name="password" value="{{ old('password') }}" required id="password" class="form-control" placeholder="Senha" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nascimento">Data de Nascimento <b class="text-red">*</b></label>
                                    <input type="date" name="birthdate" id="nascimento" required value="{{ old('birthdate') }}" class="form-control" placeholder="dd/mm/aaaa" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="genre">Gênero <b class="text-red">*</b></label>
                                    <select name="genre" id="genre" required class="form-control">
                                        <option value="">Selecione</option>
                                        <option {{(old('genre') == "M") ? 'selected' : ''}} value="M">Masculino</option>
                                        <option {{(old('genre') == "F") ? 'selected' : ''}} value="F">Feminino</option>
                                        <option {{(old('genre') == "O") ? 'selected' : ''}} value="O">Outros</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">Telefone <b class="text-red">*</b></label>
                                    <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" required class="form-control formatTEL" placeholder="(00) 0000-0000" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="mobile">Celular <b class="text-red">*</b></label>
                                    <input type="tel" name="mobile" value="{{ old('mobile') }}" required id="mobile" class="form-control formatCEL" placeholder="(00) 00000-0000" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary">
                                FINALIZAR CADASTRO
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <section class="pagamentos">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-3 col-md-3">
                        <h5>cartão de crédito</h5>
                        <div class="cartoes-credito">
                            <span class="visa"></span>
                            <span class="master"></span>
                            <span class="diners"></span>
                            <span class="amex"></span>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-3 col-md-3">
                        <h5>débito automático</h5>
                        <div class="bancos-debito">
                            <span class="caixa"></span>
                            <span class="bradesco"></span>
                            <span class="banrisul"></span>
                            <span class="santander"></span>
                            <span class="itau"></span>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-4 col-md-6">
                        <div class="ambiente-de-compra">
                            <h5>ambiente de compra seguro</h5>
                            <p>CERTIFICADO OFICIAL</p>
                            <span class="logo-app-spider">app spider</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="rodape">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                    <span class="mini-logo">
                        <img src="{{ asset('front/images/logo_folhadirigida2.png') }}" alt="">
                    </span>

                        <span class="direitos-autorais">
                        &copy; 2000-2018 . Todos os direitos reservados.
                    </span>
                    </div>
                </div>
            </div>
        </section>
    </footer>

@endsection