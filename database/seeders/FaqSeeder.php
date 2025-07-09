<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Faq; // change to your actual model name
use Illuminate\Support\Facades\DB;

class FaqSeeder extends Seeder
{
    public function run()
    {
        DB::table('faqs')->insert([
            [
                'question' => 'what is your name',
                'answer' => 'answer',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question answer' => 'what is your hobbies',
                'answer' => 'answer',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
        ]);
    }
}

