<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(DecorsTableSeeder::class);
        $this->call(ForumsTableSeeder::class);
        $this->call(ThemesTableSeeder::class);
        $this->call(MessagesTableSeeder::class);
    }
}
