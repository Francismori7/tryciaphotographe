<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        window.EventManager = {!! json_encode([
            'csrfToken' => csrf_token(),
            'user' => $user ?? null,
            'unreadNotifications' => $user ? $user->unreadNotifications_count : 0,
            'stripe' => [
                'key' => config('services.stripe.key'),
            ],
            'broadcaster' => [
                'provider' => $provider = config('broadcasting.default'),
                'key' => config("broadcasting.connections.{$provider}.key")
            ]
        ]) !!};
    </script>
</head>
<body>
    <div id="app" v-cloak>
        <div class="homepage-background">
            <div class="container">
                <div class="row mt-5">
                    <div class="col-xs-12 col-md-7">
                        <img src="{{ asset('images/logo_final_vector.svg') }}" alt="{{ config('app.name') }}"
                             class="logo img-fluid">
                    </div>
                    <div class="col-xs-12 col-md-5 text-right">
                        <a href="{{ url('login') }}" class="btn btn-secondary">
                            <i class="fa fa-user fa-fw"></i>
                            Connexion
                        </a>
                    </div>
                </div>
            </div>
            <div class="jumbotron">
                <div class="container">
                    <h1 class="display-3 hidden-sm-down">
                        {{ config('app.name') }}
                    </h1>
                    <h1 class="display-5 hidden-md-up">
                        {{ config('app.name') }}
                    </h1>
                    <p class="lead">Photographie professionnelle, évènementielle, portraits, paysages, retouche
                        photo.</p>
                    <a href="" class="btn btn-info btn-xl hidden-sm-down">
                        <i class="fa fa-camera"></i>
                        Prendre rendez-vous
                    </a>
                    <a href="" class="btn btn-info btn-lg hidden-md-up">
                        <i class="fa fa-camera"></i>
                        Prendre rendez-vous
                    </a>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div id="carouselPortraitIndicators" class="carousel slide col-md-7" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselPortraitIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselPortraitIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselPortraitIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active">
                            <img class="img-fluid" src="{{ asset('images/portrait-1.jpg') }}" alt="First slide">
                        </div>
                        <div class="carousel-item">
                            <img class="img-fluid" src="{{ asset('images/portrait-2.jpg') }}" alt="Second slide">
                        </div>
                        <div class="carousel-item">
                            <img class="img-fluid" src="{{ asset('images/portrait-3.jpg') }}" alt="Third slide">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselPortraitIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Précédent</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselPortraitIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Suivant</span>
                    </a>
                </div>

                <div class="col-md-5 p-5">
                    <h1 class="top-border-pink">Portraits magnifiques</h1>
                    <p class="lead text-muted">
                        Nous aimons vous donner l'air professionnel, enjoué, amoureux... Vos émotions sont nos atoux.
                    </p>
                    <a href="" class="btn btn-info btn-lg">
                        <i class="fa fa-camera"></i>
                        Prendre rendez-vous
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5 p-5 hidden-sm-down">
                    <h1 class="top-border-pink">Paysages fantastiques</h1>
                    <p class="lead text-muted">
                        Vos endroits préférés prennent vie avec nos photos qui donnent un effet presque féérique.
                    </p>
                    <a href="" class="btn btn-info btn-lg">
                        <i class="fa fa-camera"></i>
                        Prendre rendez-vous
                    </a>
                </div>
                <div id="carouselPaysageIndicators" class="carousel slide col-md-7" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselPaysageIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselPaysageIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselPaysageIndicators" data-slide-to="2"></li>
                        <li data-target="#carouselPaysageIndicators" data-slide-to="3"></li>
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active">
                            <img class="img-fluid" src="{{ asset('images/paysage-1.jpg') }}" alt="First slide">
                        </div>
                        <div class="carousel-item">
                            <img class="img-fluid" src="{{ asset('images/paysage-2.jpg') }}" alt="Second slide">
                        </div>
                        <div class="carousel-item">
                            <img class="img-fluid" src="{{ asset('images/paysage-3.jpg') }}" alt="Third slide">
                        </div>
                        <div class="carousel-item">
                            <img class="img-fluid" src="{{ asset('images/paysage-4.jpg') }}" alt="Fourth slide">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselPaysageIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Précédent</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselPaysageIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Suivant</span>
                    </a>
                </div>
                <div class="col-md-5 p-5 hidden-md-up">
                    <h1 class="top-border-pink">Paysages fantastiques</h1>
                    <p class="lead text-muted">
                        Vos endroits préférés prennent vie avec nos photos qui donnent un effet presque féérique.
                    </p>
                    <a href="" class="btn btn-info btn-lg">
                        <i class="fa fa-camera"></i>
                        Prendre rendez-vous
                    </a>
                </div>
            </div>
            <div class="row bg-info-gradient">
                <div class="offset-md-3 col-md-6 p-5">
                    <h1>Créez un compte personnel</h1>
                    <p class="lead">
                        Votre compte vous donne accès aux dernières nouvelles et les promotions disponibles...
                        Il vous permet également de prendre rendez-vous et de voir vos shooting photo passés.
                    </p>

                    <a href="{{ url('register') }}" class="btn btn-secondary btn-lg btn-block">S'enregistrer</a>
                </div>
            </div>
            <footer class="row bg-inverse text-white small text-center">
                <div class="offset-md-3 col-md-6 p-5">
                    <p>
                        <a href="#" class="btn btn-facebook"><i class="fa fa-fw fa-facebook" aria-hidden="true"></i></a>
                        <a href="#" class="btn btn-twitter"><i class="fa fa-fw fa-twitter" aria-hidden="true"></i></a>
                        <a href="#" class="btn btn-instagram"><i class="fa fa-fw fa-instagram"
                                                                 aria-hidden="true"></i></a>
                    </p>
                    <p class="mb-0">Copyright &copy; Trycia Turgeon Photographie {{ date('Y') }}</p>
                </div>
            </footer>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>