<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

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
        <nav class="navbar navbar-toggleable-sm navbar-inverse bg-primary">
            <div class="container">
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name') }}</a>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
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
                                <form action="{{ url('/logout') }}" method="post">
                                    {{ csrf_field() }}

                                    <button type="submit" class="btn btn-danger">
                                        {{ __("Logout") }}
                                    </button>
                                </form>
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
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>