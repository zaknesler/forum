<?php

Route::get('settings', 'Settings\SettingsController@index')->name('settings.index');

Route::post('settings/profile', 'Settings\ProfileSettingsController@update')->name('settings.profile.update');

Route::post('settings/password', 'Settings\PasswordSettingsController@update')->name('settings.password.update');

Route::post('settings/avatar', 'Settings\AvatarSettingsController@update')->name('settings.avatar.update');

Route::delete('settings/avatar', 'Settings\AvatarSettingsController@destroy')->name('settings.avatar.destroy');

Route::delete('reports/{report}', 'Report\\ReportsController@destroy')->name('reports.destroy');

/**
 * Topic routes
 */
Route::group(['prefix' => 'topics'], function () {
    Route::get('create', 'TopicsController@create')->name('topics.create');

    Route::post('/', 'TopicsController@store')->name('topics.store');

    Route::get('{topic}/edit', 'TopicsController@edit')->name('topics.edit');

    Route::put('{topic}', 'TopicsController@update')->name('topics.update');

    Route::delete('{topic}', 'TopicsController@destroy')->name('topics.destroy');

    Route::put('{topic}/report', 'Report\TopicReportsController@update')->name('topics.reports.update');

    Route::get('{topic}/reports', 'Report\TopicReportsController@show')->name('topics.reports.show');

    /**
     * Post routes
     */
    Route::post('{topic}/posts', 'PostsController@store')->name('posts.store');

    Route::group(['prefix' => 'posts'], function () {
        Route::get('{post}/edit', 'PostsController@edit')->name('posts.edit');

        Route::put('{post}', 'PostsController@update')->name('posts.update');

        Route::delete('{post}', 'PostsController@destroy')->name('posts.destroy');

        Route::put('{post}/report', 'Report\PostReportsController@update')->name('posts.reports.update');

        Route::get('{post}/reports', 'Report\PostReportsController@show')->name('posts.reports.show');
    });
});

Route::get('@{username}', 'UsersController@show')->name('users.show');
