<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(Forum\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'username' => $faker->username,
        'email' => $faker->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(Forum\Models\Topic::class, function (Faker\Generator $faker) {
    $title = $faker->sentence;

    return [
        'user_id' => function () {
            return factory(Forum\Models\User::class)->create()->id;
        },
        'title' => $title,
        'slug' => str_slug($title),
        'body' => $faker->paragraph,
    ];
});

$factory->define(Forum\Models\Post::class, function (Faker\Generator $faker) {
    return [
        'user_id' => function () {
            return factory(Forum\Models\User::class)->create()->id;
        },
        'topic_id' => function () {
            return factory(Forum\Models\Topic::class)->create()->id;
        },
        'body' => $faker->paragraph,
    ];
});
