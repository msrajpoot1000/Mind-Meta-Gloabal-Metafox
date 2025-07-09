<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class SubIndustrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sub_industries')->insert([
            [
                'name' => 'Web Development',
                'photo' => 'upload/sub_industries/web.jpg',
                'status' => 1,
                'industry_id' => 1, // Make sure this ID exists
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Cybersecurity',
                'photo' => 'upload/sub_industries/cyber.jpg',
                'status' => 1,
                'industry_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Telemedicine',
                'photo' => 'upload/sub_industries/telemed.jpg',
                'status' => 1,
                'industry_id' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
