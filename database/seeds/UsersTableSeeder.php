<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        for ($i=0;$i<3;$i++)
        {
            \App\User::firstOrCreate(['email'=>'first'.$i.'@gmail.com'],[
                'email' => 'first'.$i.'@gmail.com',
                'name' => 'first'.$i,
                'password' => bcrypt('12345678'),
            ]);
        }

    }
}
