<?php

namespace App\Repositories\V1\Address\State;

use App\Interfaces\V1\Address\State\StateRepositoryInterface;
use App\Models\CountryState;
use Exception;
use Illuminate\Support\Facades\Log;

class StateRepository implements StateRepositoryInterface
{
    /**
     * getCountryStates
     * @param int $countryId
     */
    public function getCountryStates(int $countryId): mixed
    {
        try {
            return CountryState::whereCountryId($countryId)->get();
        } catch (Exception $e) {
            Log::error('StateRepository::getCountryStates', ['error' => $e->getMessage()]);
            throw $e;
        }
    }
}
