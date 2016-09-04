<?php

Route::get('/settings', 'Settings\SettingsController@index')->name('settings.index');

Route::post('/settings/profile', 'Settings\ProfileSettingsController@update')->name('settings.profile.update');

Route::post('/settings/avatar', 'Settings\AvatarSettingsController@update')->name('settings.avatar.update');
Route::delete('/settings/avatar', 'Settings\AvatarSettingsController@destroy')->name('settings.avatar.destroy');
