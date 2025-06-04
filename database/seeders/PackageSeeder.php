<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('packages')->insert([
            [
                'type' => 'general',
                'price' => 21,
                'category' => 'basic',
                'duration' => 'month',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'type' => 'general',
                'price' => 24,
                'category' => 'basic',
                'duration' => 'month',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'type' => 'general',
                'price' => 28,
                'category' => 'standard plus',
                'duration' => 'month',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'type' => 'general',
                'price' => 30,
                'category' => 'primum',
                'duration' => 'month',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'type' => 'landlord',
                'price' => 21,
                'category' => 'basic',
                'duration' => 'month',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'type' => 'landlord',
                'price' => 24,
                'category' => 'standard',
                'duration' => 'month',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'type' => 'landlord',
                'price' => 28,
                'category' => 'standard plus',
                'duration' => 'month',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'type' => 'landlord',
                'price' => 30,
                'category' => 'primum',
                'duration' => 'month',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
