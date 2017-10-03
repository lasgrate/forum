<?php

use Faker\Generator as Faker;
use App\Models\Forum;

$factory->define(App\Models\Theme::class, function (Faker $faker) {
    return [
        'forum_id' => $faker->randomElement(Forum::pluck('id')->toArray()),
        'name' => $faker->name,
        'is_enable' => true,
        'description' => $faker->text,
        'fake_name' => $faker->name,
        'client_id' => null,
        'slug' => $faker->slug,
    ];
});
