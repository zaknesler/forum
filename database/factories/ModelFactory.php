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
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(Forum\Models\Topic::class, function (Faker\Generator $faker) {
    $title = $faker->sentence(7);

    return [
        'section_id' => $faker->numberBetween(1, 4),
        'user_id' => $faker->numberBetween(1, 2),
        'title' => $title,
        'slug' => str_slug($title),
        'body' => $faker->text(500),
    ];
});

$factory->define(Forum\Models\Post::class, function (Faker\Generator $faker) {
    return [
        'user_id' => $faker->numberBetween(1, 2),
        'body' => $faker->text(500),
    ];
});

$factory->define(Forum\Models\Role::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
        'display_name' => $faker->word,
        'description' => $faker->sentence,
    ];
});
