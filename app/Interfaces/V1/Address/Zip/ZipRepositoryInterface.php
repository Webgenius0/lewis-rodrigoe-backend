<?php

namespace App\Interfaces\V1\Address\Zip;

use App\Models\CityZip;

interface ZipRepositoryInterface
{
    /**
     * getCityZips
     * @param mixed $cityId
     */
    public function getCityZips($cityId): mixed;

    /**
     * findZip
     * @param int $id
     * @return CityZip
     */
    public function findZip(int $id): CityZip;
}
