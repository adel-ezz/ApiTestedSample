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
        //===user Seeder
         $this->call(UsersTableSeeder::class);
         //===message Seeder
        $this->call(ChatsTableSeeder::class);

    }
}
