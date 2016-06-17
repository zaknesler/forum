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
        'username' => $faker->userName,
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'location' => $faker->city . ', ' . $faker->state,
        'email' => $faker->email,
        'about' => $faker->paragraph,
        'password' => bcrypt($faker->password),
        'remember_token' => bcrypt($faker->password),
    ];
});

$factory->define(Forum\Models\Topic::class, function (Faker\Generator $faker) {
    $name = $faker->sentence(7);

    return [
        'section_id' => $faker->numberBetween(3, 5),
        'user_id' => $faker->numberBetween(1, 2),
        'name' => $name,
        'slug' => str_slug($name),
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
