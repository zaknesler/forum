<?php

Route::get('settings', 'Settings\SettingsController@index')->name('settings.index');

Route::post('settings/profile', 'Settings\ProfileSettingsController@update')->name('settings.profile.update');

Route::post('settings/password', 'Settings\PasswordSettingsController@update')->name('settings.password.update');

Route::post('settings/avatar', 'Settings\AvatarSettingsController@update')->name('settings.avatar.update');

Route::delete('settings/avatar', 'Settings\AvatarSettingsController@destroy')->name('settings.avatar.destroy');

/**
 * Topic routes
 */
Route::group(['prefix' => 'topics'], function () {
    Route::get('create', 'TopicController@create')->name('topics.create');

    Route::post('/', 'TopicController@store')->name('topics.store');

    Route::get('{topic}/edit', 'TopicController@edit')->name('topics.edit');

    Route::put('{topic}', 'TopicController@update')->name('topics.update');

    Route::delete('{topic}', 'TopicController@destroy')->name('topics.destroy');

    Route::put('{topic}/report', 'Report\TopicReportController@update')->name('topics.report.update');

    Route::delete('{topic}/report', 'Report\TopicReportController@destroy')->name('topics.report.destroy');

    /**
     * Post routes
     */
    Route::post('{topic}/posts', 'PostController@store')->name('posts.store');

    Route::group(['prefix' => 'posts'], function () {
        Route::get('{post}/edit', 'PostController@edit')->name('posts.edit');

        Route::put('{post}', 'PostController@update')->name('posts.update');

        Route::delete('{post}', 'PostController@destroy')->name('posts.destroy');

        Route::put('{post}/report', 'Report\PostReportController@update')->name('posts.report.update');

        Route::delete('{post}/report', 'Report\PostReportController@destroy')->name('posts.report.destroy');
    });
});

Route::get('@{username}', 'UserController@show')->name('users.show');
