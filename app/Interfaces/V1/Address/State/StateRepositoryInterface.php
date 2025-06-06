<?php

namespace App\Interfaces\V1\Address\State;

use App\Models\CountryState;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

interface StateRepositoryInterface
{
    /**
     * getCountryStates
     * @param int $countryId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getCountryStates(int $countryId): Collection;

    /**
     * listOfState
     * @return \Illuminate\Database\Eloquent\Builder<CountryState>
     */
    public function listOfState(): Builder;


    /**
     * storeState
     * @param array $credentials
     * @return CountryState
     */
    public function storeState(array $credentials): CountryState;

    /**
     * updateState
     * @param array $credentials
     * @param \App\Models\CountryState $state
     * @return CountryState
     */
    public function updateState(array $credentials, CountryState $state): CountryState;
}
