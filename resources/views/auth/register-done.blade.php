<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Cadastre-se para uma versão gratuita | GerentePRO</title>
    <meta charset="utf-8">

    <!-- Isso é necessário para funcionar a versão mobile -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="//assets.locaweb.com.br/locastyle/2.0.6/stylesheets/locastyle.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/fontello.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/animation.css') }}">

    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700|Roboto:300,400,500,700,900" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/ininbox.min.css') }}">

</head>
<body>

<header class="hero hero2" style="background-position: 50% 100%;">
    <div class="container">
        <center>
            <img src="{{ asset('uploads/logos/ininbox.png') }}" class="main-logo" alt="GerentePRO" />
        </center>

        <div class="row">
            <div class="col-md-7 centered text-center">
                <h1 class="hero-heading" style="font-weight: 500;">
                    Obrigado!
                </h1>

                <p class="hero-body" style="font-size: 16px;">
                    Nossa equipe estará em contato com você em breve para você começar.<br />
                    Entretanto, saiba mais sobre como os comentários do produto podem influenciar seu roteiro.
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-10 centered">
                <div class="cards">
                    <div class="card">
                        <h4>Priorização de produtos</h4>
                        <a href="#">Saber mais</a>
                    </div>

                    <div class="card">
                        <h4>Coleção de comentários</h4>
                        <a href="#">Saber mais</a>
                    </div>

                    <div class="card">
                        <h4>Gestão e moderação</h4>
                        <a href="#">Saber mais</a>
                    </div>

                    <div class="card">
                        <h4>Comunicação</h4>
                        <a href="#">Saber mais</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <p>
                    O UserVoice desenvolve software de gerenciamento de feedback de produtos que transforma a forma como as empresas reúnem e analisa os comentários dos clientes e priorizam as solicitações de recursos para direcionar as decisões estratégicas do produto.
                </p>
            </div>

            <div class="col-md-6">
                <ul class="footer-itens">
                    <li class="footer-item" style="margin-right: 30px;">
                        <a href="">
                            0800 840-0280
                        </a>
                    </li>

                    <li class="footer-item social">
                        <a href="">
                            <img class="social-img" src="{{ asset('images/icons/facebook-text-gray.svg') }}" />
                        </a>
                    </li>

                    <li class="footer-item social">
                        <a href="">
                            <img class="social-img" src="{{ asset('images/icons/twitter-text-gray.svg') }}" />
                        </a>
                    </li>

                    <li class="footer-item social">
                        <a href="">
                            <img class="social-img" src="{{ asset('images/icons/linkedin-text-gray.svg') }}" />
                        </a>
                    </li>
                </ul>

                <p class="powered-by">
                    Desenvolvido por <a href="#">Codemax Sistemas</a>
                </p>
            </div>
        </div>
    </div>
</footer>

<!-- Scripts - Atente-se na ordem das chamadas -->
<script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/locastyle.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>

</body>
</html>