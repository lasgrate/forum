<?php

use Faker\Generator as Faker;
use App\Models\Client;
use App\Models\Forum;

$factory->define(App\Models\Message::class, function (Faker $faker) {

    $client_id = $faker->randomElement(Client::pluck('id')->toArray());

    $theme_id = null;

    while (!$theme_id) {

        $client_id = $faker->randomElement(Client::pluck('id')->toArray());

        $forum_id = Client::find($client_id)->forum->id;

        $theme_id = $faker->randomElement(Forum::find($forum_id)->themes()->pluck('id')->toArray());
    }

    return [
        'client_id' => $client_id,
        'theme_id' => $theme_id,
        'text' => $faker->text,
        'is_enable' => $faker->randomElement([0, 1]),
        'user_view' => $faker->randomElement([0, 1]),
        'client_view' => $faker->randomElement([0, 1]),
    ];
});
