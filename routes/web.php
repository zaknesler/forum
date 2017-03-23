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

Route::get('/', 'TopicController@index');

Route::get('/settings', 'Settings\SettingsController@index')->name('settings.index');
Route::patch('/settings/profile', 'Settings\ProfileSettingsController@update')->name('settings.profile.update');

Route::resource('/topics', 'TopicController', ['except' => ['show']]);
Route::get('/topics/{slug}', 'TopicController@show')->name('topics.show');

Auth::routes();
