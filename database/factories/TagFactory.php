<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(App\Tag::class, function (Faker $faker) {
    return [
        //
        'name' => Str::random(5),
    ];
});
