<?php

Route::get('settings', 'Settings\SettingsController@index')->name('settings.index');

Route::post('settings/profile', 'Settings\ProfileSettingsController@update')->name('settings.profile.update');

Route::post('settings/avatar', 'Settings\AvatarSettingsController@update')->name('settings.avatar.update');
Route::delete('settings/avatar', 'Settings\AvatarSettingsController@destroy')->name('settings.avatar.destroy');

/**
 * Topic routes
 */

Route::group([], function () {
    Route::get('topics', 'TopicController@index')->name('topics.index');

    Route::get('topics/create', 'TopicController@create')->name('topics.create');

    Route::post('topics', 'TopicController@store')->name('topics.store');

    Route::get('topics/{topic}/edit', 'TopicController@edit')->name('topics.edit');

    Route::put('topics/{topic}', 'TopicController@update')->name('topics.update');

    Route::delete('topics/{topic}', 'TopicController@destroy')->name('topics.destroy');

    Route::get('topics/{slug}/{topic}', 'TopicController@show')->name('topics.show');
});
