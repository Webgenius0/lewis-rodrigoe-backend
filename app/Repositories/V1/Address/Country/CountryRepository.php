<?php

namespace App\Repositories\V1\Address\Country;

use App\Helpers\Helper;
use App\Interfaces\V1\Address\Country\CountryRepositoryInterface;
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


    /**
     * create Country
     * @param array $credential
     * @return Country
     */
    public function createCountry(array $credential): Country
    {
        try {
            return Country::create([
                'name' => $credential['name'],
                'slug' => Helper::generateUniqueSlug($credential['name'], 'countries'),
            ]);
        } catch (Exception $e) {
            Log::error('CountryRepository::createCountry', ['error' => $e->getMessage()]);
            throw $e;
        }
    }


    /**
     * update  country
     * @param array $credential
     * @param \App\Models\Country $country
     * @return void
     */
    public function updateCountry(array $credential, Country $country)
    {
        try {
            $oldName = $country->name;
            $country->name = $credential['name'];

            if ($oldName != $credential['name']) {
                $country->slug = Helper::generateUniqueSlug($credential['name'], 'countries', 'slug');
            }

            $country->save();
        } catch (Exception $e) {
            Log::error('CountryRepository::updateCountry', ['error' => $e->getMessage()]);
            throw $e;
        }
    }
}
