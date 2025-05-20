<?php

namespace App\Interfaces\V1\Address\City;

interface CityRepositoryInterface
{
    /**
     * getStateCities
     * @param int $stateId
     * @return mixed
     */
    public function getStateCities(int $stateId): mixed;
}
