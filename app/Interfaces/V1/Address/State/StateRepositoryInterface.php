<?php

namespace App\Interfaces\V1\Address\State;

interface StateRepositoryInterface
{
    /**
     * getCountryStates
     * @param int $countryId
     */
    public function getCountryStates(int $countryId);
}
