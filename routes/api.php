<?php

Route::resource('topics', 'TopicController', ['except' => ['show', 'edit', 'create']]);
