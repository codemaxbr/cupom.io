<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">

    <!-- Isso é necessário para funcionar a versão mobile -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <title>Login | GerentePRO</title>

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="//assets.locaweb.com.br/locastyle/2.0.6/stylesheets/locastyle.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/fontello.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/animation.css') }}">

    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700|Roboto:300,400,500,700,900" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/ininbox.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/ininbox.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-social.css') }}">

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
                <img src="{{ asset('uploads/logos/mova.png') }}" class="img-responsive" />
            </h1>

            <form role="form" method="post" action="{{ route('cliente.login.submit') }}" autocomplete="off">
                {{ csrf_field() }}

                <fieldset>
                    <div class="form-group ls-login-user">
                        <label for="userLogin">Endereço de E-mail</label>
                        <input class="form-control ls-login-bg-user" value="{{ old('email') }}" name="email" id="userLogin" type="email" aria-label="Endereço de E-mail" autocomplete="off" placeholder="Endereço de E-mail" required>
                    </div>

                    <div class="form-group ls-login-password">
                        <label for="userPassword">Senha</label>
                        <input class="form-control ls-login-bg-password" name="password" id="userPassword" type="password" aria-label="Senha" autocomplete="off" placeholder="Senha" required>
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>

                    <a href="{{ route('password.request') }}" class="ls-login-forgot">Esqueci minha senha</a>

                    <input type="submit" value="Entrar" class="btn btn-primary btn-lg btn-block">

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

                    @if (session('success'))
                        <div class="alert alert-success">
                            <i class="icone-spin3 animate-spin"></i>
                            {{ session('success') }}
                        </div>
                @endif

                <!-- pensando se deixo isso ou não -->
                    <p class="txt-center ls-login-signup" style="padding-top: 0px;">
                        ou<br />

                        <a href="{{ url('/auth/facebook') }}" class="btn btn-social btn-sm btn-facebook" rel="loginFacebook">
                            <i class="icone-facebook-squared-1"></i>Facebook
                        </a>

                        <a href="{{ url('/auth/google') }}" class="btn btn-social btn-sm btn-google" rel="loginFacebook">
                            <i class="icone-gplus-1"></i>Google
                        </a>
                    </p>


                </fieldset>
            </form>
        </div>

    </div>
</div>

<script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/locastyle.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function() {
        /*
        $.ajaxSetup({ cache: true });
        $.getScript('https://connect.facebook.net/pt_BR/sdk.js', function(){
            FB.init({
                appId: '180736722358672',
                version: 'v2.11' // or v2.1, v2.2, v2.3, ...
            });
            $('#loginbutton,#feedbutton').removeAttr('disabled');
        });

        $('[rel="loginFacebook"]').on('click', function () {

            FB.login(function(response) {
                // handle the response
                console.log(response);

                if (response.authResponse) {
                    console.log('Welcome!  Fetching your information.... ');
                    FB.api('/me', {fields: 'last_name, email, location'}, function(response) {
                        //console.log('Good to see you, ' + response.name + '.');
                        console.log(response);
                    });
                } else {
                    console.log('User cancelled login or did not fully authorize.');
                }

            }, {scope: 'public_profile,email, user_location, user_hometown'});
        });
        */
    });
</script>

</body>
</html>