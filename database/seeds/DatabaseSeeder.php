<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // so before using the new seeder need to init here
         // $this->call(UsersTableSeeder::class);
         $this->call(SettingTableSeeder::class);
    }
}
