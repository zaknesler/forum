<?php

Route::get('', 'HomeController@index')->name('home');

Route::group(['middleware' => ['guest']], function () {
    Route::get('auth/sign-up', 'Auth\AuthController@getRegister')->name('auth.register');
    Route::post('auth/sign-up', 'Auth\AuthController@postRegister');

    Route::get('auth/sign-in', 'Auth\AuthController@getLogin')->name('auth.login');
    Route::post('auth/sign-in', 'Auth\AuthController@postLogin');

    Route::get('password/email', 'Auth\PasswordController@getEmail')->name('auth.password.email');
    Route::post('password/email', 'Auth\PasswordController@postEmail');
    
    Route::get('password/reset/{token}', 'Auth\PasswordController@getReset')->name('auth.password.reset');
    Route::post('password/reset/{token}', 'Auth\PasswordController@postReset');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('home', 'HomeController@home')->name('auth.home');

    Route::get('account/settings/profile', 'Account\AccountController@getProfile')->name('account.settings.profile');
    Route::post('account/settings/profile', 'Account\AccountController@postProfile');

    Route::get('auth/sign-out', 'Auth\AuthController@logout')->name('auth.logout');
});
