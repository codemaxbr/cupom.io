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
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/x-icon">

</head>
<body>

<header class="hero">
    <div class="container">
        <div class="row relative">
            <div class="col-md-6">
                <a href="#">
                    <img src="{{ asset('uploads/logos/ininbox.png') }}" class="main-logo" alt="GerentePRO" />
                </a>

                <h1 class="hero-heading">
                    Obtenha uma versão gratuita do software líder em gerenciamento de host
                </h1>
            </div>

            <div class="form-wrap">
                <h3 class="form-heading">
                    Inscreva-se para uma avaliação gratuita
                </h3>
                <p>Todos os campos são obrigatórios</p>

                <form method="post" action="{{ route('register') }}">
                    {{ csrf_field() }}

                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group{{ $errors->has('domain') ? ' has-error' : '' }}">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="domain" id="domain" placeholder="suaempresa" value="{{ old('domain') }}" required autofocus>
                                    <div class="input-group-addon">.gerentepro.com.br</div>
                                </div>

                                @if ($errors->has('domain'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('domain') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group{{ $errors->has('name_business') ? ' has-error' : '' }}">
                                <input id="name_business" type="text" class="form-control" name="name_business" placeholder="Nome da Empresa" value="{{ old('name_business') }}" required>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name_business') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <input id="name" type="text" placeholder="Nome Completo" class="form-control" name="name" value="{{ old('name') }}" required>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <input id="email" name="email" value="{{ old('email') }}" type="email" placeholder="Email principal" class="form-control" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <input id="password" type="password" class="form-control" name="password" value="" placeholder="Senha" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="g-recaptcha" data-sitekey="6LeWDNkSAAAAAC0KTBTv2Gs4WzFv8QAKQ9vh6k3v"></div>
                        </div>

                        <div class="col-md-12 text-center">
                            <div class="form-group">
                                <button type="submit" class="btn btn-submit">
                                    Começar agora
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</header>

<article class="section container">
    <div class="row">
        <div class="col-md-4">
            <img src="{{ asset('images/icons/voice.svg') }}" class="feature-img" />
            <h3 class="feature-heading">
                Dê aos clientes, parceiros ou equipes internas uma voz
            </h3>

            <p class="feature-body">
                Nós fornecemos uma maneira estruturada para você coletar comentários de produtos de clientes internos e externos e ajudá-lo a priorizar essas ideias de produtos, tudo em um único sistema.

                Além disso, integre esse feedback de cada departamento falando com os clientes.
            </p>
        </div>

        <div class="col-md-4">
            <img src="{{ asset('images/icons/roadmap-data.svg') }}" class="feature-img" />
            <h3 class="feature-heading">
                Crie seu roteiro com dados reais
            </h3>

            <p class="feature-body">
                Nossa ferramenta SmartVote ™ ajuda a construir um consenso dentro da sua organização, eliminando a ambiguidade sobre a direção do roteiro do seu produto.

                Defina seu roteiro com ciência de dados e significância estatística, usando métricas como receita e satisfação do cliente.
            </p>
        </div>

        <div class="col-md-4">
            <img src="{{ asset('images/icons/features.svg') }}" class="feature-img" />
            <h3 class="feature-heading">
                Priorize as características que importam
            </h3>

            <p class="feature-body">
                Com o nosso Advanced Trend Reporting, você pode identificar rapidamente idéias de produtos quentes ou inovadoras. Avalie se o desejo do usuário por uma idéia está aumentando mais rapidamente ou lentamente e se certas idéias e preocupações com os usuários permanecem relevantes ao longo do tempo.
            </p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <img src="{{ asset('images/icons/right-place.svg') }}" class="feature-img" />
            <h3 class="feature-heading">
                Esteja no lugar certo no momento certo
            </h3>

            <p class="feature-body">
                UserVoice permite que você colete comentários e idéias diretamente em seu aplicativo (web ou celular) com uma experiência de usuário nativa ou em fóruns de feedback on-line etiquetados privados.
            </p>
        </div>

        <div class="col-md-4">
            <img src="{{ asset('images/icons/reduce-noise.svg') }}" class="feature-img" />
            <h3 class="feature-heading">
                Reduza o barulho
            </h3>

            <p class="feature-body">
                Para maiores equipes de gerenciamento de produtos, habilitamos cada administrador a acessar suas informações mais relevantes em um clique, garantindo que cada gerenciador de produtos possa capturar atualizações críticas para seu produto específico.
            </p>
        </div>

        <div class="col-md-4">
            <img src="{{ asset('images/icons/adoption.svg') }}" class="feature-img" />
            <h3 class="feature-heading">
                Impulsionar nova adoção de recursos
            </h3>

            <p class="feature-body">
                Nós o ajudamos a identificar e comunicar aos clientes que solicitam recursos para que você possa envolvê-los durante o teste beta e após o lançamento para que você possa dirigir a adoção e a felicidade do cliente.
            </p>
        </div>
    </div>
</article>

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
                            <img class="social-img" src="{{ asset('images/icons/facebook-text-gray.sv') }}g" />
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

<script src='https://www.google.com/recaptcha/api.js?hl=pt-BR'></script>
</body>
</html>