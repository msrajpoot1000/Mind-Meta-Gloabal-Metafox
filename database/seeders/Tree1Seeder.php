<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Tree1Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        DB::table('tree1s')->insert([
            [
                'img1' => 'upload/tree1s/sample.jpg',
                'img2' => 'upload/tree1s/sample.jpg',
                'img3' => 'upload/tree1s/sample.jpg',
                'description1' => 'Sample description1',
                'description2' => 'Sample description2',
                'description3' => 'Sample description3',
                'name' => 'Sample name',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
