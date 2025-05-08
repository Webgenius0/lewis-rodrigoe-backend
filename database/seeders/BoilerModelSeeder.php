<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BoilerModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('boiler_models')->insert([
            [
                'slug' => 'vaillant-ecoTec-plus',
                'name' => 'Vaillant ecoTEC Plus',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => 'worcester-greenstar-8000',
                'name' => 'Worcester Greenstar 8000',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => 'ideal-logic-c30',
                'name' => 'Ideal Logic C30',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => 'baxi-600',
                'name' => 'Baxi 600 Combi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => 'viessmann-vitodens-100-w',
                'name' => 'Viessmann Vitodens 100-W',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

    }
}
