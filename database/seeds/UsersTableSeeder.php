<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        DB::table('users')->insert([
//            'company_id' => 1,
//            'name' => 'Admin',
//            'email' => 'admin@brbhospital.com',
//            'role_id'=>1,
//            'password' => bcrypt('pass123'),
//        ]);
        DB::table('users')->insert([
            'company_id' => 1,
            'name' => 'Doctor',
            'email' => 'doctor@brbhospital.com',
            'role_id'=>1,
            'password' => bcrypt('pass123'),
        ]);
    }
}
