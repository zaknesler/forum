<?php

Route::get('/', 'TopicController@index')->name('home');

Route::redirect('/home', '/');

Route::group(['prefix' => 'settings'], function () {
    Route::get('/', 'Settings\SettingsController@index')->name('settings.index');

    Route::patch('profile', 'Settings\ProfileController@update')->name('settings.profile.update');
    Route::patch('password', 'Settings\PasswordController@update')->name('settings.password.update');
    Route::patch('avatar', 'Settings\AvatarController@update')->name('settings.avatar.update');
    Route::delete('avatar', 'Settings\AvatarController@destroy')->name('settings.avatar.destroy');
});

Route::resource('topics', 'TopicController', ['except' => ['show', 'index']]);

Route::group(['prefix' => 'topics'], function () {
    Route::resource('{topic}/posts', 'PostController', ['except' => ['show', 'index', 'create']]);

    Route::get('{slug}', 'TopicController@show')->name('topics.show');
});

Route::get('@{username}', 'UserController@show')->name('users.show');

Auth::routes();
