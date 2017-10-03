<?php

use Illuminate\Database\Seeder;

class DecorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Decor::class, 2)->create();
    }
}
