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

        /**
     * update  country
     * @param array $credential
     * @param \App\Models\Country $country
     * @return void
     */
    public function updateCountry(array $credential, Country $country): void;


}
