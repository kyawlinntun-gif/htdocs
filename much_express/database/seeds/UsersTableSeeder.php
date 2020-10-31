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
        \App\User::create(['name' => 'Tun Tun', 'email' => 'tuntun@gmail.com', 'password' => bcrypt('12345678')]);
    }
}
