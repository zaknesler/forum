<?php

Route::resource('topics', 'TopicController', ['except' => ['show', 'edit', 'create']]);
Route::get('/topics/{slug}', 'TopicController@show')->name('topics.show');
