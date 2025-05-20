<?php

namespace App\Interfaces\V1\Address\Zip;

interface ZipRepositoryInterface
{
    /**
     * getCityZips
     * @param mixed $cityId
     */
    public function getCityZips($cityId): mixed;
}
