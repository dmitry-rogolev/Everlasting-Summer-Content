<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NavigationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("navigations")->insert([
            [
                "name" => "О проекте", 
                "path" => "description", 
                "uri" => null, 
                "created_at" => new DateTime("now"), 
                "updated_at" => new DateTime("now"), 
            ], 
            [
                "name" => "test", 
                "path" => null, 
                "uri" => null, 
                "created_at" => new DateTime("now"), 
                "updated_at" => new DateTime("now"), 
            ], 
        ]);
    }
}
