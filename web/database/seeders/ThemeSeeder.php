<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ThemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("themes")->insert([
            [
                "name" => "Светлая", 
                "theme" => "light",
                "inversion" => 2,  
            ], 
            [
                "name" => "Темная", 
                "theme" => "dark", 
                "inversion" => 1, 
            ], 
        ]);
    }
}