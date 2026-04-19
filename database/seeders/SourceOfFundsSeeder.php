<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SourceOfFundsSeeder extends Seeder
{
    public function run(): void
    {
        $sources = [
            ['name' => 'Salary'],
            ['name' => 'Business Income'],
            ['name' => 'Investment Income'],
            ['name' => 'Savings'],
            ['name' => 'Inheritance'],
            ['name' => 'Other']
        ];

        DB::table('source_of_funds')->insert($sources);
    }
}
