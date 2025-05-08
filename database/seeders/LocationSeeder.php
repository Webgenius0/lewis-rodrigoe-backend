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
                'Greater London' => [
                    ['name' => 'London', 'zip' => 'EC1A'],
                    ['name' => 'Croydon', 'zip' => 'CR0'],
                    ['name' => 'Bromley', 'zip' => 'BR1'],
                    ['name' => 'Romford', 'zip' => 'RM1'],
                    ['name' => 'Harrow', 'zip' => 'HA1'],
                    ['name' => 'Ealing', 'zip' => 'W5'],
                    ['name' => 'Barnet', 'zip' => 'EN5'],
                    ['name' => 'Hackney', 'zip' => 'E8'],
                    ['name' => 'Islington', 'zip' => 'N1'],
                    ['name' => 'Greenwich', 'zip' => 'SE10'],
                ],
                'West Midlands' => [
                    ['name' => 'Birmingham', 'zip' => 'B1'],
                    ['name' => 'Coventry', 'zip' => 'CV1'],
                    ['name' => 'Wolverhampton', 'zip' => 'WV1'],
                    ['name' => 'Solihull', 'zip' => 'B91'],
                    ['name' => 'Dudley', 'zip' => 'DY1'],
                    ['name' => 'Walsall', 'zip' => 'WS1'],
                    ['name' => 'West Bromwich', 'zip' => 'B70'],
                    ['name' => 'Sutton Coldfield', 'zip' => 'B72'],
                    ['name' => 'Smethwick', 'zip' => 'B66'],
                    ['name' => 'Halesowen', 'zip' => 'B63'],
                ],
            ],
            'Scotland' => [
                'Glasgow City' => [
                    ['name' => 'Glasgow', 'zip' => 'G1'],
                    ['name' => 'Partick', 'zip' => 'G11'],
                    ['name' => 'Govan', 'zip' => 'G51'],
                    ['name' => 'Maryhill', 'zip' => 'G20'],
                    ['name' => 'Pollokshields', 'zip' => 'G41'],
                    ['name' => 'Shawlands', 'zip' => 'G43'],
                    ['name' => 'Hillhead', 'zip' => 'G12'],
                    ['name' => 'Springburn', 'zip' => 'G21'],
                    ['name' => 'Dennistoun', 'zip' => 'G31'],
                    ['name' => 'Castlemilk', 'zip' => 'G45'],
                ],
                'Edinburgh' => [
                    ['name' => 'Edinburgh', 'zip' => 'EH1'],
                    ['name' => 'Leith', 'zip' => 'EH6'],
                    ['name' => 'Morningside', 'zip' => 'EH10'],
                    ['name' => 'Portobello', 'zip' => 'EH15'],
                    ['name' => 'Corstorphine', 'zip' => 'EH12'],
                    ['name' => 'Gorgie', 'zip' => 'EH11'],
                    ['name' => 'Newington', 'zip' => 'EH9'],
                    ['name' => 'Stockbridge', 'zip' => 'EH4'],
                    ['name' => 'Granton', 'zip' => 'EH5'],
                ],
            ],
            'Wales' => [
                'South Glamorgan' => [
                    ['name' => 'Cardiff', 'zip' => 'CF10'],
                    ['name' => 'Penarth', 'zip' => 'CF64'],
                    ['name' => 'Barry', 'zip' => 'CF62'],
                    ['name' => 'Llanishen', 'zip' => 'CF14'],
                    ['name' => 'Taffs Well', 'zip' => 'CF15'],
                    ['name' => 'Pontcanna', 'zip' => 'CF11'],
                    ['name' => 'Cathays', 'zip' => 'CF24'],
                ],
            ],
            'Northern Ireland' => [
                'County Antrim' => [
                    ['name' => 'Belfast', 'zip' => 'BT1'],
                    ['name' => 'Lisburn', 'zip' => 'BT28'],
                    ['name' => 'Newtownabbey', 'zip' => 'BT36'],
                    ['name' => 'Carrickfergus', 'zip' => 'BT38'],
                    ['name' => 'Antrim', 'zip' => 'BT41'],
                    ['name' => 'Larne', 'zip' => 'BT40'],
                    ['name' => 'Ballymena', 'zip' => 'BT43'],
                    ['name' => 'Crumlin', 'zip' => 'BT29'],
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
