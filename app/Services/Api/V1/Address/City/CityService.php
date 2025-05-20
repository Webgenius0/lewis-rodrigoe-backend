<?php

namespace App\Services\Api\V1\Address\City;

use App\Interfaces\V1\Address\City\CityRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\Log;

class CityService
{
    /**
     * cityRepository
     * @var CityRepositoryInterface
     */
    private CityRepositoryInterface $cityRepository;

    /**
     * construct
     * @param \App\Interfaces\V1\Address\City\CityRepositoryInterface $cityRepository
     */
    public function __construct(CityRepositoryInterface $cityRepository)
    {
        $this->cityRepository = $cityRepository;
    }

    /**
     * getStateCitiesIndex
     * @param mixed $stateId
     */
    public function getStateCitiesIndex($stateId)
    {
        try {
            return $this->cityRepository->getStateCities($stateId);
        } catch (Exception $e) {
            Log::error('CityService::getStateCitiesIndex', ['error' => $e->getMessage()]);
            throw $e;
        }
    }
}
