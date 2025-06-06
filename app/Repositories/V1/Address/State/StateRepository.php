<?php

namespace App\Repositories\V1\Address\State;

use App\Helpers\Helper;
use App\Interfaces\V1\Address\State\StateRepositoryInterface;
use App\Models\CountryState;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;

class StateRepository implements StateRepositoryInterface
{
    /**
     * getCountryStates
     * @param int $countryId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getCountryStates(int $countryId): Collection
    {
        try {
            return CountryState::select(['id', 'name', 'slug'])->whereCountryId($countryId)->get();
        } catch (Exception $e) {
            Log::error('StateRepository::getCountryStates', ['error' => $e->getMessage()]);
            throw $e;
        }
    }


    /**
     * listOfState
     * @return \Illuminate\Database\Eloquent\Builder<CountryState>
     */
    public function listOfState():Builder
    {
        try {
            return CountryState::query();
        } catch (Exception $e) {
            Log::error('App\Repositories\Web\Backend\V1\Dropdown\StateRepository::listOfState', ['error' => $e->getMessage()]);
            throw $e;
        }
    }

    /**
     * storeState
     * @param array $credentials
     * @return CountryState
     */
    public function storeState(array $credentials):CountryState
    {
        try {
            return CountryState::create([
                'name' => $credentials['name'],
                'country_id' => $credentials['country_id'],
                'slug' => Helper::generateUniqueSlug($credentials['name'], 'states', 'slug'),
            ]);
        } catch (Exception $e) {
            Log::error('App\Repositories\Web\Backend\V1\Dropdown\StateRepository::storeState', ['error' => $e->getMessage()]);
            throw $e;
        }
    }

    /**
     * updateState
     * @param array $credentials
     * @param \App\Models\CountryState $state
     * @return CountryState
     */
    public function updateState(array $credentials, CountryState $state): CountryState
    {
        try {
            $state->update([
                'name' => $credentials['name'],
                'country_id' => $credentials['country_id'],
               'slug' => Helper::generateUniqueSlug($credentials['name'], 'states', 'slug'),
            ]);
            return $state;
        } catch (Exception $e) {
            Log::error('App\Repositories\Web\Backend\V1\Dropdown\StateRepository::updateState', ['error' => $e->getMessage()]);
            throw $e;
        }
    }
}
