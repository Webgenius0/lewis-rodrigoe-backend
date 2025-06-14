<?php

namespace App\Interfaces\V1\Address\City;

use App\Models\StateCity;
use Illuminate\Database\Eloquent\Collection;

interface CityRepositoryInterface
{
    /**
     * getStateCities
     * @param int $stateId
     * @return mixed
     */
    public function getStateCities(int $stateId): mixed;

    /**
     * listOfCity
     * @return \Illuminate\Database\Eloquent\Collection<int, StateCity>
     */
    public function listOfCity(): Collection;

    /**
     * create City
     * @param array $credential
     * @return StateCity
     */
    public function createCity(array $credential): StateCity;

    /**
     * updateCity
     * @param array $credential
     * @param \App\Models\StateCity $city
     * @return StateCity
     */
    public function updateCity(array $credential, StateCity $city): StateCity;
}
