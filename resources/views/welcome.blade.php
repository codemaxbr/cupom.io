<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .top-left {
            position: absolute;
            left: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            letter-spacing: -0.3px;
        }

        span.plano{
            font-weight: 600;
            color: #777;
            background: #f7f7f7;
            padding: 10px;
            border: 1px solid #eeeeee;
            margin-bottom: 10px;
            display: block;
        }

        span.plano b{
            color: #000;
            font-weight: 700;
        }

        span.plano button{
            background: #0a568c;
            color: #ffffff;
            font-family: "Raleway", "Lato", Arial, sans-serif;
            font-weight: 600;
            border: 0px;
            padding: 5px;
            margin-left: 10px;
            text-transform: uppercase;
            cursor: pointer;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    @if (Route::has('login'))

        <div class="top-left links">
            <a href="{{ route('checkout') }}">Carrinho de Compras ({{ $items }})</a>
        </div>

        <div class="top-right links">
            @if (Auth::check())
                <a href="{{ route('home') }}">Home</a>
            @else
                <a href="{{ route('login') }}">Entrar</a>
            @endif
        </div>
    @endif

    <div class="content">
        <div class="title m-b-md">
            <img src="{{ asset('uploads/logos/ininbox.png') }}" class="img-responsive" />
        </div>

        <h1>Assine já</h1>

        <div class="links">
        @forelse($planos as $plano)

            <!-- Precisa ser selecionado dessa forma (FORM POST), se for do tipo GET (link) vai ficar vulnerável -->
                <form action="{{ route('checkout.assinatura', $plano->uuid) }}" method="post">
                    @csrf
                    <span class="plano">
                                <b>{{ $plano->name }} - ({{ $plano->payment_cycle->name }})</b> - R$ {{ numFormat($plano->price) }}

                        <button type="submit">
                                    Contratar
                                </button>
                            </span>
                </form>
            @empty
                Nenhum plano cadastrado.
            @endforelse
        </div>
    </div>
</div>
</body>
</html>
