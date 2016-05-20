<?php

Route::get('', 'HomeController@index')->name('home');

/**
 * Guest routes
 */

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

/**
 * Authenticated routes
 */

Route::group(['middleware' => ['auth']], function () {
    Route::get('auth/sign-out', 'Auth\AuthController@logout')->name('auth.logout');

    Route::get('account/settings/profile', 'Account\AccountController@getProfile')->name('account.settings.profile');
    Route::post('account/settings/profile', 'Account\AccountController@postProfile');

    Route::get('sections', 'Forum\SectionController@index')->name('forum.section.all');
    Route::get('section/{id}', 'Forum\SectionController@show')->name('forum.section.show');

    Route::get('topics', 'Forum\TopicController@all')->name('forum.topic.all');
    Route::get('topic/{id}', 'Forum\TopicController@show')->name('forum.topic.show');

    Route::get('topic', 'Forum\TopicController@index')->name('forum.topic.new');
    Route::post('topic', 'Forum\TopicController@store');

    Route::post('topic/{topic}/post', 'Forum\PostController@store');
});
