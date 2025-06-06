<?php

namespace App\Interfaces\V1\Address\Country;

use App\Models\Country;
use Illuminate\Database\Eloquent\Collection;

interface CountryRepositoryInterface
{
    /**
     *  list Of country types
     * @return Country
     */
    public function listOfCountry(): mixed;

    /**
     * create Country
     * @param array $credential
     * @return Country
     */
    public function createCountry(array $credential): Country;

    public function updateCountry(array $credential, Country $country);
}
