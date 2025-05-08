<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                'slug' => 'admin',
                'name' => 'Admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => 'owner',
                'name' => 'Owner',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => 'landlord',
                'name' => 'Landlord',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => 'engineer',
                'name' => 'Engineer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
