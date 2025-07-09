<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\ContentPagesContentsSeeder;
use Database\Seeders\FaqSeeder;
use Database\Seeders\HomeSliderSeeder;
use Database\Seeders\ContactSeeder;
use Database\Seeders\TestimonialSeeder;
use Database\Seeders\SubIndustrySeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\CompanyInfoSeeder;


use Database\Seeders\IndustrySeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // ✅ Call your content pages seeder here
        $this->call(ContentPagesContentsSeeder::class);
        $this->call(FaqSeeder::class);
        $this->call(HomeSliderSeeder::class);
        $this->call(ContactSeeder::class);
        $this->call([TestimonialSeeder::class,]);
        $this->call([IndustrySeeder::class,]);
        $this->call([SubIndustrySeeder::class,]);
        $this->call([UserSeeder::class,]);
        $this->call([CompanyInfoSeeder::class,]);
        
        
    }
}
