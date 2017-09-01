<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Topic::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory(App\Models\User::class)->create()->id;
        },
        'title' => $faker->sentence,
        'body' => $faker->paragraphs(5, true),
    ];
});
