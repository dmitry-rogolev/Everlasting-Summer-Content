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
                "name" => "light",
                "inversion_id" => 2,  
            ], 
            [
                "name" => "dark", 
                "inversion_id" => 1, 
            ], 
        ]);
    }
}
