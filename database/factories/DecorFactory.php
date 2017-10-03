<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Decor::class, function (Faker $faker) {
    return [
        'name' => $faker->name
    ];
});
