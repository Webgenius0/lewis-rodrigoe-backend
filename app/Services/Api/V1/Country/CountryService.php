<?php

namespace App\Services\Api\V1\Country;

use App\Interfaces\V1\Country\CountryRepositoryInterface;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;

class CountryService
{
    /**
     * countryRepository
     * @var CountryRepositoryInterface
     */
    private CountryRepositoryInterface $countryRepository;

    /**
     * construct
     * @param \App\Interfaces\V1\Country\CountryRepositoryInterface $countryRepository
     */
    public function __construct(CountryRepositoryInterface $countryRepository)
    {
        $this->countryRepository = $countryRepository;
    }


    /**
     * getIndex
     * @return \Illuminate\Database\Eloquent\Collection<int, \App\Models\Country>
     */
    public function getIndex(): Collection
    {
        try {
            return $this->countryRepository->getList();
        }catch (Exception $e) {
            Log::error('CountryService::getIndex', ['error' => $e->getMessage()]);
            throw $e;
        }
    }

}
