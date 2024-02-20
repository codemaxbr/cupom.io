<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">

    <!-- Isso é necessário para funcionar a versão mobile -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <title>GerentePRO | Redefinir Senha</title>

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="//assets.locaweb.com.br/locastyle/2.0.6/stylesheets/locastyle.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/fontello.css') }}">
    <link rel="stylesheet" type="text/css" href="assets/css/animation.css">

    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700|Roboto:300,400,500,700,900" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/ininbox.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/ininbox.min.css') }}">

    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/x-icon">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body>

<div class="parent-login">
    <div class="parent-inner">

        <div class="box-login">
            <h1 class="ls-login-logo">
                <img src="{{ asset('uploads/logos/ininbox.png') }}" class="img-responsive" />
            </h1>

            <div class="login-box-msg">
                Redefinir Senha
            </div>

            <form role="form" method="post" action="{{ route('password.request') }}">
                {{ csrf_field() }}

                <input type="hidden" name="token" value="{{ $token }}">

                <fieldset>
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} ls-login-user">
                        <label for="userLogin">Endereço de E-mail</label>
                        <input class="form-control ls-login-bg-user" value="{{ old('email') }}" name="email" id="userLogin" type="email" aria-label="Endereço de E-mail" placeholder="Endereço de E-mail" required autofocus>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                {{ $errors->first('email') }}
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} ls-login-password">
                        <label for="userPassword">Senha</label>
                        <input class="form-control ls-login-bg-password" name="password" id="userPassword" type="password" aria-label="Senha" placeholder="Senha" required>
                        @if ($errors->has('password'))
                            <span class="help-block">
                                {{ $errors->first('password') }}
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }} ls-login-password">
                        <label for="confirmPassword">Confirmar Senha</label>
                        <input class="form-control ls-login-bg-password" name="password_confirmation" id="confirmPassword" type="password" aria-label="Senha" placeholder="Confirmar Senha" required>
                        @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                                {{ $errors->first('password_confirmation') }}
                            </span>
                        @endif
                    </div>

                    <input type="submit" value="Redefinir Senha" class="btn btn-primary btn-lg btn-block">


                    @if ($errors->has('email'))
                        <div class="alert alert-danger">
                            <i class="icone-attention-5"></i>
                            {{ $errors->first('email') }}
                        </div>
                    @endif

                    @if (session('status'))
                        <div class="alert alert-info">
                            <i class="icone-spin3 animate-spin"></i>
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- pensando se deixo isso ou não -->
                    <p class="txt-center ls-login-signup">
                        Já tem uma conta? <a class="btn-link" href="{{ route('login') }}">Faça Login</a>
                    </p>


                </fieldset>
            </form>
        </div>

    </div>
</div>

<script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/locastyle.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>

</body>
</html>