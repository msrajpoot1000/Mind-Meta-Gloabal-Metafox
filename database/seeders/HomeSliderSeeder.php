<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HomeSliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('home_sliders')->insert([
            [
                'title' => 'title',
                'description' => 'description',
                'image' => 'image',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'title2',
                'description' => 'description',
                'image' => 'image',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
        ]);
 
        
    }
}
