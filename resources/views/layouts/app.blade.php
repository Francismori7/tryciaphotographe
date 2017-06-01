<!DOCTYPE html>
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

    <title>@yield('title', '') - {{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.ProductManager = {!! json_encode([
            'csrfToken' => csrf_token(),
            'broadcaster' => [
                        'provider' => $provider = config('broadcasting.default'),
                        'key' => config("broadcasting.connections.{$provider}.key")
            ]
        ]) !!};
    </script>
</head>
<body>
    <div id="app" v-cloak>
        <nav class="navbar navbar-toggleable-md navbar-fixed-top bg-success navbar-inverse">
            <div class="container">
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                        data-target="#navigation" aria-controls="navigation"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name') }}</a>

                <div class="collapse navbar-collapse" id="navigation">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ route('home.index') }}">{{ __("Home") }}</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav mr-0">
                        @if(auth()->guest())
                            <li class="nav-item">
                                <a href="{{ url('/login') }}" class="nav-link">{{ __('Login') }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/register') }}" class="nav-link">{{ __('Register') }}</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a href="#" class="nav-link" @click.prevent="showNotifications">
                                    @if(auth()->user()->unreadNotifications->count())
                                        <i class="fa fa-bell"></i>
                                    @else
                                        <i class="fa fa-bell-o"></i>
                                    @endif
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('dashboard.index') }}" class="nav-link">{{ auth()->user()->name }}</a>
                            </li>
                            <li class="nav-item">
                                <logout class="nav-link"></logout>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">
            @include('flash::message')

            @yield('content')
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>