<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
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
        <nav class="navbar navbar-toggleable-md fixed-top bg-faded navbar-light">
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
                    @can('view all users')
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ route('admin.users.index') }}">{{ __("Users") }}</a>
                        </li>
                    @endcan
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
                            <a href="{{ route('dashboard.notifications.index') }}" class="nav-link">
                                    <span v-if="!!unreadNotifications">
                                        <i class="fa fa-bell text-danger"></i>
                                        <span class="badge badge-pill badge-danger" v-text="unreadNotifications"></span>
                                    </span>
                                <i class="fa fa-bell-o" v-else></i>
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
        </nav>

        <div class="content">
            <div class="container-fluid">
                @include('flash::message')
            </div>

            @yield('content')
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>

    @if(isset($currentDashboardPage) && $currentDashboardPage === 'billing')
        <script>
            let stripe = Stripe(EventManager.stripe.key);
            let elements = stripe.elements();

            let postalCode = '';

            // Custom styling can be passed to options when creating an Element.
            let options = {
                style: {
                    base: {
                        // Add your base input styles here. For example:
                        fontSize: '1.063rem',
                        lineHeight: '1.5'
                    }
                }
            };

            // Create an instance of the card Element
            let card = elements.create('card', options);

            // Add an instance of the card Element into the `card-element` <div>
            card.mount('#card-element');

            card.addEventListener('change', function (event) {
                let displayError = document.getElementById('card-errors');
                if (event.error) {
                    displayError.textContent = event.error.message;
                } else {
                    displayError.textContent = '';
                }
            });

            // Create a token or display an error when the form is submitted.
            let form = document.getElementById('billing-form');
            form.addEventListener('submit', function (event) {
                event.preventDefault();

                let options = {
                    name: document.querySelector('input[name="name"]').value,
                    address_line1: document.querySelector('input[name="address_line1"]').value,
                    address_line2: document.querySelector('input[name="address_line2"]').value,
                    address_city: document.querySelector('input[name="address_city"]').value,
                    address_state: document.querySelector('input[name="address_state"]').value,
                    address_zip: postalCode,
                    address_country: 'Canada',
                };

                stripe.createToken(card, options).then(function (result) {
                    if (result.error) {
                        // Inform the user if there was an error
                        let errorElement = document.getElementById('card-errors');
                        errorElement.textContent = result.error.message;
                    } else {
                        // Send the token to your server
                        stripeTokenHandler(result.token);
                    }
                });
            });

            function stripeTokenHandler(token) {
                // Insert the token ID into the form so it gets submitted to the server
                let form = document.getElementById('billing-form');
                let hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'stripeToken');
                hiddenInput.setAttribute('value', token.id);
                form.appendChild(hiddenInput);

                let postalCodeInput = document.createElement('input');
                postalCodeInput.setAttribute('type', 'hidden');
                postalCodeInput.setAttribute('name', 'address_zip');
                postalCodeInput.setAttribute('value', postalCode);
                form.appendChild(postalCodeInput);

                // Submit the form
                form.submit();
            }

            card.on('change', function (event) {
                postalCode = event.value.postalCode;
            });
        </script>
    @endif
</body>
</html>