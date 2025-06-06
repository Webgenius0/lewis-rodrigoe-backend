<?php

namespace App\Interfaces\V1\Address\Country;

use App\Models\Country;
use Illuminate\Database\Eloquent\Collection;

interface CountryRepositoryInterface
{
    /**
     * getList
     * @return Collection<int, Country>
     */
    public function getList(): Collection;

    /**
     * create Country
     * @param array $credential
     * @return Country
     */
    public function createCountry(array $credential): Country;

    public function updateCountry(array $credential, Country $country);
}
