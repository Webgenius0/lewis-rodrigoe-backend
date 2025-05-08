<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PropertyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('property_types')->insert([
            [
                'slug' => 'apartment',
                'name' => 'Apartment',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => 'house',
                'name' => 'House',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => 'bungalow',
                'name' => 'Bungalow',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => 'villa',
                'name' => 'Villa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => 'duplex',
                'name' => 'Duplex',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => 'studio',
                'name' => 'Studio',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => 'penthouse',
                'name' => 'Penthouse',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => 'townhouse',
                'name' => 'Townhouse',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => 'farmhouse',
                'name' => 'Farmhouse',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => 'cottage',
                'name' => 'Cottage',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

    }
}
