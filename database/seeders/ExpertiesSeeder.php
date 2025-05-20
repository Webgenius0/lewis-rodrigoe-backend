<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExpertiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('expertises')->insert([
            [
                'slug' => 'engineer',
                'name' => 'Engineer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => 'plumber',
                'name' => 'Plumber',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => 'both',
                'name' => 'Both',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
