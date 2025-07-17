<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('testimonials')->insert([
            [
                'client_name' => 'Alice Johnson',
                'client_position' => 'Marketing Manager',
                'description' => 'Their service was top-notch, and communication was clear and professional.',
                'photo1' => '',
                'rating' => 5,
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'client_name' => 'Robert Singh',
                'client_position' => 'CEO, TechCraft',
                'description' => 'Highly recommended! Delivered beyond expectations.',
                'photo1' => '',
                'rating' => 4,
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
