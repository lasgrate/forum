<?php

use Illuminate\Database\Seeder;

class ForumsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Forum::class, 4)->create()->each(function ($forum) {
            $forum->clients()->saveMany(factory(App\Models\Client::class, 3)->make());
        });
    }
}
