<?php

Auth::routes();
Route::get('/activate/{code}', 'Auth\RegisterController@activate')->name('activate');

Route::get('email', function() {
    return new \App\Mail\AccountActivationEmail(new \App\User());
});

Route::get('/', 'HomeController@index')->name('home.index');
Route::get('/dashboard', 'DashboardController@index')->name('dashboard.index');
