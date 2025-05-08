<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('services')->insert([
            [
                'slug' => 'plumbing',
                'name' => 'Plumbing',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => 'clectrical',
                'name' => 'Electrical',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => 'drainage',
                'name' => 'Drainage',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => 'heating',
                'name' => 'Heating',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
