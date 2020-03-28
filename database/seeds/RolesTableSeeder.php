<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'company_id' => 1,
            'name' => 'Doctor',
            'status' => true
        ]);

        DB::table('roles')->insert([
            'company_id' => 1,
            'name' => 'Assistant',
            'status' => true
        ]);

        DB::table('roles')->insert([
            'company_id' => 1,
            'name' => 'Others',
            'status' => true
        ]);
    }
}
