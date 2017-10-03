<?php

use Faker\Generator as Faker;
use App\Models\User;
use App\Models\Decor;

$factory->define(App\Models\Forum::class, function (Faker $faker) {
    return [
        'decor_id' => $faker->randomElement(Decor::pluck('id')->toArray()),
        'title' => $faker->name,
        'name'  => $faker->name,
        'description' => $faker->text,
        'logo' => null,
        'user_id' => $faker->randomElement(User::where('role', 'like', 'partner')->pluck('id')->toArray()),
    ];
});
