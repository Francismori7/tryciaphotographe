<?php
/******************************************************************************
 * Copyright (c) 2017. Mori7 Technologie inc. Tous droits réservés.           *
 ******************************************************************************/

Auth::routes();
Route::get('auth/google/redirect', 'Auth\GoogleController@redirect')->name('google.redirect');
Route::get('auth/google/callback', 'Auth\GoogleController@callback')->name('google.callback');

Route::get('/activate/{code}', 'Auth\RegisterController@activate')->name('activate');

Route::get('test', function() {
    return App\User::first()->oauth()->get();
});

Route::get('/', 'HomeController@index')->name('home.index');
Route::get('/dashboard', 'DashboardController@index')->name('dashboard.index');
