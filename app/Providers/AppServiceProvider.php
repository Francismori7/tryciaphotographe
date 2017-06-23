<?php
/******************************************************************************
 * Copyright (c) 2017. Mori7 Technologie inc. Tous droits réservés.           *
 ******************************************************************************/

namespace App\Providers;

use App\Http\ViewCreators\UserCreator;
use App\User;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Laravel\Cashier\Cashier;
use Stripe\Stripe;
use View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::defaultView('pagination::bootstrap-4');
        Paginator::defaultSimpleView('pagination::simple-bootstrap-4');

        Cashier::useCurrency('cad');
        Stripe::setApiKey(config('services.stripe.secret'));

        Carbon::setLocale('fr');
        setlocale(LC_ALL, 'fr-CA');

        View::creator(['layouts.app', 'home.index'], UserCreator::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
