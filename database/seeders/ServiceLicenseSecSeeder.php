<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceLicenseSecSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        DB::table('service_license_secs')->insert([
            [
                'license_image' => 'upload/service_license_secs/sample.jpg',
                'license_name' => 'Sample license_name',
                'license_description' => 'Sample license_description',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
