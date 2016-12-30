<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::group(['prefix' => 'topics'], function () {
    Route::get('/', 'TopicsController@index')->name('topics.index');

    Route::get('{slug}/{topic}', 'TopicsController@show')->name('topics.show');
});
