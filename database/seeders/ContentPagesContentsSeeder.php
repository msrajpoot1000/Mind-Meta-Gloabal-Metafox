<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // ✅ THIS IS MISSING


class ContentPagesContentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('content_pages_contents')->insert([
            [
                'type' => 'privacy_policy',
                'heading' => 'Privacy Policy',
                'description' => '<p>This is our privacy policy content...</p>',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'cookie_policy',
                'heading' => 'Cookie Policy',
                'description' => '<p>This is our cookie policy content...</p>',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'terms_conditions',
                'heading' => 'Terms & Conditions',
                'description' => '<p>These are our terms and conditions...</p>',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
