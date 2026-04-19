<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    public function run(): void
    {
        $countries = [
            ['name' => 'Nigeria', 'code' => 'NG'],
            ['name' => 'United States of America', 'code' => 'US'],
            ['name' => 'India', 'code' => 'IN'],
            ['name' => 'United Kingdom', 'code' => 'GB'],
            ['name' => 'Canada', 'code' => 'CA'],
            ['name' => 'Australia', 'code' => 'AU'],
        ];

        DB::table('countries')->insert($countries);
    }
}
