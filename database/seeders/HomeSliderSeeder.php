<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HomeSliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        DB::table('home_sliders')->insert([
            [
                'banner_image' => 'upload/home_sliders/sample.jpg',
                'banner_heading' => 'Sample banner_heading',
                'banner_sub_heading' => 'Sample banner_sub_heading',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
