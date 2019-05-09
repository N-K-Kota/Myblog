<?php

use Faker\Generator as Faker;
use Carbon\Carbon;
$factory->define(App\Article::class, function (Faker $faker) {
    return [
        //
        'article' => $faker->text,
        'title' => $faker->word,
    ];
});
