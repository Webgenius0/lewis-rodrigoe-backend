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
                'slug' => 'combi-boiler',
                'name' => 'Combi Boiler',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => 'system-boiler',
                'name' => 'System Boiler',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => 'regular-boiler',
                'name' => 'Regular Boiler',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => 'oil-boiler',
                'name' => 'Oil Boiler',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => 'electric-boiler',
                'name' => 'Electric Boiler',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

    }
}
