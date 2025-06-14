<?php

namespace App\Repositories\V1\Address\City;

use App\Helpers\Helper;
use App\Interfaces\V1\Address\City\CityRepositoryInterface;
use App\Models\StateCity;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;

class CityRepository implements CityRepositoryInterface
{
    /**
     * getStateCities
     * @param int $stateId
     * @return mixed
     */
    public function getStateCities(int $stateId): mixed
    {
        try {
            return StateCity::select(['id', 'name', 'slug'])->whereStateId($stateId)->get();
        } catch (Exception $e) {
            Log::error('CityRepository::getCountryStates', ['error' => $e->getMessage()]);
            throw $e;
        }
    }

    /**
     * listOfCity
     * @return \Illuminate\Database\Eloquent\Collection<int, StateCity>
     */
    public function listOfCity(): Collection
    {
        try {
            return StateCity::with(['state', 'state.country'])->get();
        } catch (Exception $e) {
            Log::error('CityRepository::listOfCity', ['error' => $e->getMessage()]);
            throw $e;
        }
    }

    /**
     * create City
     * @param array $credential
     * @return StateCity
     */
    public function createCity(array $credential): StateCity
    {
        try {
            // Ensure state_id is either valid or null
            $stateId = isset($credential['state_id']) && !empty($credential['state_id']) ? $credential['state_id'] : null;

            return StateCity::create([
                'name' => $credential['name'],
                'country_id' => $credential['country_id'],
                'country_state_id' => $stateId,
                'slug' => Helper::generateUniqueSlug($credential['name'], 'state_cities'),
            ]);
        } catch (Exception $e) {
            Log::error('CountryRepository::createCity', ['error' => $e->getMessage()]);
            throw $e;
        }
    }

    /**
     * updateCity
     * @param array $credential
     * @param \App\Models\StateCity $city
     * @return StateCity
     */
    public function updateCity(array $credential, StateCity $city): StateCity
    {
        try {
            $city->name = $credential['name'];
            $city->country_id = $credential['country_id'];
            $city->country_state_id = $credential['state_id'];
            $city->slug = Helper::generateUniqueSlug($credential['name'], 'state_cities');
            $city->update();
            return $city;
        } catch (Exception $e) {
            Log::error('CityRepository::updateCity', ['error' => $e->getMessage()]);
            throw $e;
        }
    }
}
