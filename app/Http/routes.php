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

    Route::get('section/{slug}', 'Forum\SectionController@show')->name('forum.section.show');

    Route::get('topic/{slug}/{id}', 'Forum\TopicController@show')->name('forum.topic.show');

    Route::get('topic/create', 'Forum\TopicController@index')->name('forum.topic.create');
    Route::post('topic/create', 'Forum\TopicController@store');

    Route::post('topic/{topic}/post', 'Forum\PostController@store')->name('forum.topic.post');
});

Route::group(['prefix' => 'moderation', 'middleware' => ['ability:owner|admin,remove-topic']], function () {
    Route::get('sections', 'Forum\SectionController@all')->name('moderation.section.all');

    Route::get('topics', 'Forum\TopicController@all')->name('moderation.topic.all');
    Route::get('topic/destroy/{id}', 'Moderation\TopicController@destroy')->name('moderation.topic.destroy');

    Route::get('section/{slug}', 'Moderation\SectionController@show')->name('moderation.section.show');

    Route::get('section/create', 'Forum\SectionController@create')->name('moderation.section.create');
    Route::post('section/create', 'Forum\SectionController@store');

    Route::get('section/destroy/{id}', 'Moderation\SectionController@destroy')->name('moderation.section.destroy');
});
