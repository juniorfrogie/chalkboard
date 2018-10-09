<?php

use Faker\Generator as Faker;

$factory->define(App\Question::class, function (Faker $faker) {
    return [
        'title' => rtrim($faker->sentence(rand(5,10)), "."),
        'content' => $faker->paragraphs(rand(3,7), true),
        'views' => rand(0,10),
        'answers' => rand(0,10),
        'votes' => rand(-10,10)
    ];
});
