<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Conta inválida</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            
            <div class="col-md-12 text-center" style="margin-top: 130px;">
                <h1><b>Conta inválida</b></h1>
                <h3>Não encontramos a conta para: <b>{{ $_SERVER['HTTP_HOST'] }}</b></h3>
                <img src="{{ asset('images/404.png') }}" alt="" class="img-responsive" style="margin-top: 20px;">
            </div>
        </div>
    </nav>

    @yield('content')
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
