<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companies')->insert([
            'name' => 'BRB Hospitals Limited',
            'address' => '77/A, East Rajabazar,West Oanthapath, Dhaka-1215',
            'city' => 'Dhaka',
            'country'=>'Bangladesh',
            'email' => 'info@brbhospital.com',
            'currency' =>'BDT',
            'website' => 'www.brbhospital.com'
        ]);
    }
}
