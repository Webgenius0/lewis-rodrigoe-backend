<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Country;
use App\Models\CountryState;
use App\Models\StateCity;
use App\Models\CityZip;

class LocationSeeder extends Seeder
{
    public function run(): void
    {
        $ukData = [
            'England' => [
                'London' => [
                    ['name' => 'London', 'zip' => 'EC1A'],
                    ['name' => 'Buckinghamshire', 'zip' => 'CR0'],
                    ['name' => 'Hertfordshire', 'zip' => 'BR1'],
                    ['name' => 'Bedfordshire', 'zip' => 'RM1'],
                ],
            ],
        ];

        foreach ($ukData as $countryName => $states) {
            $country = Country::create([
                'slug' => Str::slug($countryName),
                'name' => $countryName,
            ]);

            foreach ($states as $stateName => $cities) {
                $state = CountryState::create([
                    'country_id' => $country->id,
                    'slug' => Str::slug($stateName),
                    'name' => $stateName,
                ]);

                foreach ($cities as $city) {
                    $cityModel = StateCity::create([
                        'country_state_id' => $state->id,
                        'slug' => Str::slug($city['name']),
                        'name' => $city['name'],
                    ]);

                    CityZip::create([
                        'state_city_id' => $cityModel->id,
                        'slug' => strtolower($city['zip']),
                        'number' => $city['zip'],
                    ]);
                }
            }
        }
    }
}
