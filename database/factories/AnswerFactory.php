<?php

use Faker\Generator as Faker;

$factory->define(App\Answer::class, function (Faker $faker) {
    return [
        'content' => $faker->paragraph(rand(3,7), true),
        'user_id' => App\User::pluck('id')->random(),
        'votes' => rand(0,5)
    ];
});
