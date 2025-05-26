<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OnlineHourSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('online_hours')->insert([
            [
                'slot' => '06:30am - 03:00pm',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slot' => '09:00am - 05:00pm',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slot' => '12:00am - 08:00pm',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slot' => '08:00pm - 07:00am',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

    }
}
