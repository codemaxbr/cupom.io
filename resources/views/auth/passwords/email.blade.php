<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">

    <!-- Isso é necessário para funcionar a versão mobile -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <title>GerentePRO | Recuperar Senha</title>

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
                Recuperar Senha
            </div>

            <form role="form" method="post" action="{{ route('password.email') }}">
                {{ csrf_field() }}

                <fieldset>
                    <div class="form-group ls-login-user">
                        <label for="userLogin">Endereço de E-mail</label>
                        <input class="form-control ls-login-bg-user" value="{{ old('email') }}" name="email" id="userLogin" type="email" aria-label="Endereço de E-mail" placeholder="Endereço de E-mail" required>
                    </div>

                    <input type="submit" value="Enviar Link" class="btn btn-primary btn-lg btn-block">


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