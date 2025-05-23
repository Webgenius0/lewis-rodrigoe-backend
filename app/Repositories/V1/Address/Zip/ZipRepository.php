<?php

namespace App\Repositories\V1\Address\Zip;

use App\Interfaces\V1\Address\Zip\ZipRepositoryInterface;
use App\Models\CityZip;
use Exception;
use Illuminate\Support\Facades\Log;

class ZipRepository implements ZipRepositoryInterface
{
    /**
     * getCityZips
     * @param mixed $cityId
     */
    public function getCityZips($cityId): mixed
    {
        try {
            return CityZip::select(['id', 'number', 'slug'])->whereStateCityId($cityId)->get();
        } catch (Exception $e) {
            Log::error('ZipRepository::getCityZips', ['error' => $e->getMessage()]);
            throw $e;
        }
    }

    /**
     * findZip
     * @param int $id
     * @return CityZip
     */
    public function findZip(int $id): CityZip
    {
        try {
            return CityZip::findOrFail($id);
        }catch(Exception $e) {
            Log::error('ZipRepository::findZip', ['error' => $e->getMessage()]);
            throw $e;
        }
    }
}
