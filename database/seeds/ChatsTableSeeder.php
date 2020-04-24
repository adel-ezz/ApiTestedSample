<?php

use Illuminate\Database\Seeder;
use   \Illuminate\Support\Facades\DB;

class ChatsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i <= 20; $i++):
            DB::table('chats')
                ->insert([
                    'subject' => $faker->sentence,
                    'message' => $faker->paragraph,
                    'sender_id'=> 1,
                    'receiver_id'=>2,
                    'archive'=>1,
                    'room'=>1
                ]);
            DB::table('chats')
                ->insert([
                    'subject' => $faker->sentence,
                    'message' => $faker->paragraph,
                    'sender_id'=> 1,
                    'receiver_id'=>3,
                    'room'=>2
                ]);
        endfor;
    }
}
