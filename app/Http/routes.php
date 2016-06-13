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

    Route::get('account/settings/profile', 'Account\ProfileController@index')->name('account.settings.profile');
    Route::post('account/settings/profile', 'Account\ProfileController@update');

    Route::get('account/settings/password', 'Account\PasswordController@index')->name('account.settings.password');
    Route::post('account/settings/password', 'Account\PasswordController@update');

    Route::get('@{username}', 'User\UserController@profile')->name('user.profile');

    Route::get('topic/{id}/report', 'Forum\TopicController@report')->name('forum.topic.report');
    Route::get('topic/post/{id}/report', 'Forum\PostController@report')->name('forum.post.report');

    Route::get('topic/{id}/edit', 'Forum\EditTopicController@index')->name('forum.topic.edit');
    Route::post('topic/{id}/edit', 'Forum\EditTopicController@update');

    Route::get('topic/create/{id?}', 'Forum\TopicController@create')->name('forum.topic.create');
    Route::post('topic/create/{id?}', 'Forum\TopicController@store');

    Route::post('topic/{topic}/post', 'Forum\PostController@store')->name('forum.topic.post');
});

/**
 * Moderation routes for moderators, administrators, and owners.
 */
Route::group(['middleware' => ['role:moderator|admin|owner']], function () {
    Route::get('users', 'User\UserController@index')->name('user.list');

    Route::get('reports', 'Report\ReportController@index')->name('report.reports');

    Route::get('topic/post/{id}/report/clear', 'Forum\PostController@clearReports')->name('forum.post.report.clear');
    Route::get('topic/{id}/report/clear', 'Forum\TopicController@clearReports')->name('forum.topic.report.clear');

    Route::get('section/{id}/edit', 'Forum\EditSectionController@index')->name('forum.section.edit');
    Route::post('section/{id}/edit', 'Forum\EditSectionController@update');

    Route::get('post/{id}/destroy', 'Forum\PostController@destroy')->name('forum.post.destroy');
    Route::get('topic/{id}/destroy', 'Forum\TopicController@destroy')->name('forum.topic.destroy');
});

/**
 * Moderation routes for administrators and owners.
 */
Route::group(['middleware' => ['role:owner|admin']], function () {
    Route::get('user/{id}/edit', 'User\EditController@index')->name('user.edit');
    Route::post('user/{id}/edit', 'User\EditController@update');

    Route::post('user/{id}/edit/password', 'User\PasswordController@update')->name('user.edit.password');

    Route::get('section/create', 'Forum\SectionController@create')->name('forum.section.create');
    Route::post('section/create', 'Forum\SectionController@store');

    Route::get('section/{id}/destroy', 'Forum\SectionController@destroy')->name('forum.section.destroy');
});

/**
 * Moderation routes for owners.
 */
Route::group(['middleware' => ['role:owner|admin']], function () {
    Route::post('user/{id}/edit/role', 'User\RoleController@update')->name('user.edit.role');
});

Route::get('section/{slug}/{id}', 'Forum\SectionController@show')->name('forum.section.show');
Route::get('topic/{slug}/{id}', 'Forum\TopicController@show')->name('forum.topic.show');
