<?php

Route::get('', 'HomeController@index')->name('home');

Route::group(['middleware' => ['guest']], function () {
    Route::get('auth/register', 'Auth\AuthController@getRegister')->name('auth.register');
    Route::post('auth/register', 'Auth\AuthController@postRegister');

    Route::get('auth/login', 'Auth\AuthController@getLogin')->name('auth.login');
    Route::post('auth/login', 'Auth\AuthController@postLogin');

    Route::get('password/email', 'Auth\PasswordController@getEmail')->name('auth.password.email');
    Route::post('password/email', 'Auth\PasswordController@postEmail');
    
    Route::get('password/reset/{token}', 'Auth\PasswordController@getReset')->name('auth.password.reset');
    Route::post('password/reset/{token}', 'Auth\PasswordController@postReset');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('home', 'HomeController@home')->name('auth.home');

    Route::get('account/settings/profile', 'Account\AccountController@getProfile')->name('account.settings.profile');
    Route::post('account/settings/profile', 'Account\AccountController@postProfile');

    Route::get('auth/logout', 'Auth\AuthController@logout')->name('auth.logout');
});
