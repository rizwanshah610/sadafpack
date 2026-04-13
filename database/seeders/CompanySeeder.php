<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = [
            ['name' => 'PackCo Industries',  'email' => 'info@packco.com',     'phone' => '0300-1234567', 'address' => 'Lahore, Pakistan',      'website' => 'www.packco.com'],
            ['name' => 'SafePack Ltd',       'email' => 'contact@safepack.com','phone' => '0321-9876543', 'address' => 'Karachi, Pakistan',     'website' => 'www.safepack.com'],
            ['name' => 'BoxMaster',          'email' => 'hello@boxmaster.com', 'phone' => '0333-5556677', 'address' => 'Islamabad, Pakistan',   'website' => 'www.boxmaster.com'],
            ['name' => 'FlexiPack Co',       'email' => 'sales@flexipack.com', 'phone' => '0345-1122334', 'address' => 'Faisalabad, Pakistan',  'website' => 'www.flexipack.com'],
            ['name' => 'GreenWrap',          'email' => 'info@greenwrap.com',  'phone' => '0311-9988776', 'address' => 'Gujranwala, Pakistan',  'website' => 'www.greenwrap.com'],
        ];

        foreach ($companies as $company) {
            \App\Models\Company::create($company);
        }
    }
}
