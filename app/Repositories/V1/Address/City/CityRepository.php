<?php

namespace App\Repositories\V1\Address\City;

use App\Interfaces\V1\Address\City\CityRepositoryInterface;
use App\Models\StateCity;
use Exception;
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
}
