<?php

namespace App\Services\Web\V1\Location;

use App\Interfaces\V1\Address\Country\CountryRepositoryInterface;
use Exception;
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
     * @param \App\Interfaces\V1\Address\Country\CountryRepositoryInterface $countryRepository
     */
    public function __construct(CountryRepositoryInterface $countryRepository)
    {
        $this->countryRepository = $countryRepository;
    }

    /**
     * countryIndex
     * @param mixed $request
     * @return void
     */
    public function countryIndex($request)
    {
        try {
            
        }catch (Exception $e) {
            Log::error('CountryService::countryIndex', [$e->getMessage()]);
            throw $e;
        }
    }
}
