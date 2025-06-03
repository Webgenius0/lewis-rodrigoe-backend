<?php

namespace App\Interfaces\V1\Package;

use Illuminate\Database\Eloquent\Collection;

interface PackageRepositoryInterface
{
    /**
     * getPackagesByType
     * @param string $type
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getPackagesByType(string $type): Collection;
}
