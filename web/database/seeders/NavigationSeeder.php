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
                "list" => 1, 
                "name" => "О проекте", 
                "path" => "description", 
                "sub" => null, 
                "created_at" => new DateTime("now"), 
                "updated_at" => new DateTime("now"), 
            ], 
            [
                "list" => 1, 
                "name" => "test", 
                "path" => null, 
                "sub" => 2, 
                "created_at" => new DateTime("now"), 
                "updated_at" => new DateTime("now"), 
            ], 
            [
                "list" => 2, 
                "name" => "test1", 
                "path" => "test/test1", 
                "sub" => null, 
                "created_at" => new DateTime("now"), 
                "updated_at" => new DateTime("now"), 
            ], 
            [
                "list" => 2, 
                "name" => "test2", 
                "path" => "test/test2", 
                "sub" => null, 
                "created_at" => new DateTime("now"), 
                "updated_at" => new DateTime("now"), 
            ], 
        ]);
    }
}
