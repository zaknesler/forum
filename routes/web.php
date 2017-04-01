<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'TopicController@index')->name('home');

Route::get('settings', 'Settings\SettingsController@index')->name('settings.index');
Route::patch('settings/profile', 'Settings\ProfileSettingsController@update')->name('settings.profile.update');
Route::patch('settings/password', 'Settings\PasswordSettingsController@update')->name('settings.password.update');

Route::resource('topics', 'TopicController', ['except' => ['show', 'index']]);

Route::group(['prefix' => 'topics'], function() {
    Route::get('{slug}', 'TopicController@show')->name('topics.show');

    Route::resource('{topic}/posts', 'PostController', ['except' => ['show', 'index', 'create']]);
});


Auth::routes();
