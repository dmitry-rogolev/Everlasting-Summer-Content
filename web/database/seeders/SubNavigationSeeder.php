<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class SubNavigationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("sub_navigations")->insert([
            [
                "name" => "test1", 
                "path" => "test/test1", 
                "uri" => null, 
                "navigation_id" => 2, 
                "created_at" => new DateTime("now"), 
                "updated_at" => new DateTime("now"), 
            ], 
            [
                "name" => "test2", 
                "path" => "test/test2", 
                "uri" => null, 
                "navigation_id" => 2, 
                "created_at" => new DateTime("now"), 
                "updated_at" => new DateTime("now"), 
            ],  
        ]);
    }
}
