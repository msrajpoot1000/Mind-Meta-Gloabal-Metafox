<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Carbon;

class CompanyInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('companyinfos')->insert([
            'companyname' => 'MetaFox Technologies',
            'logo' => 'upload/company/logo.png',
            'email' => 'info@metafox.com',
            'phone' => '1234567890',
            'phone2' => '9876543210',
            'phone3' => '1122334455',
            'address' => '123 Business Avenue, Tech City, India',
            'facebook' => 'https://facebook.com/metafox',
            'instagram' => 'https://instagram.com/metafox',
            'linkedin' => 'https://linkedin.com/company/metafox',
            'pinterest' => 'https://pinterest.com/metafox',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
