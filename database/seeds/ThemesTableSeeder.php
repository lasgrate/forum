<?php

use Illuminate\Database\Seeder;

class ThemesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Theme::class, 60)->create()->each(function ($theme) {
            $theme->tags()->saveMany(factory(App\Models\Tag::class, 1)->make());
        });
    }
}
