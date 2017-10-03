<?php

use Faker\Generator as Faker;
use App\Models\Forum;

$factory->define(App\Models\Tag::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'forum_id' => $faker->randomElement(Forum::pluck('id')->toArray()),
    ];
});
