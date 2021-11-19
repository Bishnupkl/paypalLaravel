<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
    {
        \Illuminate\Support\Facades\DB::table('users')->insert([
            'name'=>'Paypal Uk',
            'email'=>'connect@paypal.com',
            'password'=>bcrypt('secret'),
            'phone_number'=>'9811990067',
            'address'=>'butwal',
            'is_admin'=>1,
            'is_verified'=>1,
        ]);
    }
}
