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
         DB::table('users')->insert([
            'name' => 'kraken',
            'email' => 'kraken@gmail.com',
            'password' => bcrypt('kraken'),
        ]);
    }
}
