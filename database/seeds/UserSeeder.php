<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'fname' => "admin",
            'lname' => "Demo",
            'email' => "praf@gmail.com",
            'role' => 1,
            'password' => hash::make("123456789"),
        ]);
    }
}
