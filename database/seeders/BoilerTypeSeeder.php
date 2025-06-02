<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BoilerTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('boiler_types')->insert([
            [
                'slug' => 'system-boiler',
                'name' => 'System boiler',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => 'system-boiler',
                'name' => 'Combination boiler',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => 'hyeatin-only-boiler',
                'name' => 'Heating Only boiler',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => 'ashp',
                'name' => 'ASHP',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => 'gshp',
                'name' => 'GSHP',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

    }
}
