<?php
/******************************************************************************
 * Copyright (c) 2017. Mori7 Technologie inc. Tous droits réservés.           *
 ******************************************************************************/

Route::post('stripe/webhooks', 'Webhooks\StripeWebhooksController@handleWebhook')->name('stripe.webhooks');

Auth::routes();
Route::get('auth/google/redirect', 'Auth\GoogleController@redirect')->name('google.redirect');
Route::get('auth/google/callback', 'Auth\GoogleController@callback')->name('google.callback');
Route::get('auth/facebook/redirect', 'Auth\FacebookController@redirect')->name('facebook.redirect');
Route::get('auth/facebook/callback', 'Auth\FacebookController@callback')->name('facebook.callback');
Route::get('auth/twitter/redirect', 'Auth\TwitterController@redirect')->name('twitter.redirect');
Route::get('auth/twitter/callback', 'Auth\TwitterController@callback')->name('twitter.callback');

Route::get('/activate/{code}', 'Auth\RegisterController@activate')->name('activate');

Route::get('test', function () {
    /*for ($i = 1; $i <= 10; $i++) {
        auth()->user()->notify(new \App\Notifications\NewShootingPublished());
    }*/
    auth()->user()->notify(new \App\Notifications\NewShootingPublished());

//    return view('test');
});

Route::get('/', 'HomeController@index')->name('home.index');

Route::get('/dashboard', 'DashboardController@index')->name('dashboard.index');

Route::get('/dashboard/notifications', 'DashboardNotificationsController@index')->name('dashboard.notifications.index');
Route::get('/dashboard/notifications/read',
    'DashboardNotificationsController@destroyAll')->name('dashboard.notifications.destroyAll');
Route::delete('/dashboard/notifications/{id}',
    'DashboardNotificationsController@destroy')->name('dashboard.notifications.destroy');

Route::get('/dashboard/billing', 'DashboardBillingController@index')->name('dashboard.billing.index');
Route::patch('/dashboard/billing', 'DashboardBillingController@update')->name('dashboard.billing.update');
