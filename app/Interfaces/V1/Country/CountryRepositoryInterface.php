<?php

namespace App\Interfaces\V1\Country;

use App\Models\Country;
use Illuminate\Database\Eloquent\Collection;

interface CountryRepositoryInterface
{
    /**
     * getList
     * @return Collection<int, Country>
     */
    public function getList(): Collection;
}
