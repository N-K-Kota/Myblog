<?php

use Faker\Generator as Faker;
use App\Userblog;
$factory->define(Userblog::class, function (Faker $faker) {
    return [
        //
        'user_id' => mt_rand(1,5),
        'title' => $faker->word,
        'category' => $faker->word
    ];
});
