<?php

namespace App\Services\Api\V1\Address\State;

use App\Interfaces\V1\Address\State\StateRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\Log;

class StateService
{
    /**
     * stateRepository
     * @var StateRepositoryInterface
     */
    private StateRepositoryInterface $stateRepository;

    /**
     * __construct
     * @param \App\Interfaces\V1\Address\State\StateRepositoryInterface $stateRepository
     */
    public function __construct(StateRepositoryInterface $stateRepository)
    {
        $this->stateRepository = $stateRepository;
    }

    /**
     * getCountryStateIndex
     * @param mixed $countryId
     */
    public function getCountryStateIndex($countryId): mixed
    {
        try {
            return $this->stateRepository->getCountryStates($countryId);
        } catch (Exception $e) {
            Log::error('StateService::getCountryStateIndex', ['error' => $e->getMessage()]);
            throw $e;
        }
    }
}
