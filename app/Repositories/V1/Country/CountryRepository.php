<?php

namespace App\Repositories\V1\Country;

use App\Interfaces\V1\Country\CountryRepositoryInterface;
use App\Models\Country;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;

class CountryRepository implements CountryRepositoryInterface
{
    /**
     * getList
     * @return Collection<int, Country>
     */
    public function getList():Collection
    {
        try {
            return Country::select(['id','name', 'slug'])->get();
        }catch(Exception $e) {
            Log::error('CountryRepository::getList', ['error' => $e->getMessage()]);
            throw $e;
        }
    }
}
