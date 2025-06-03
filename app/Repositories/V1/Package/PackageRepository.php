<?php

namespace App\Repositories\V1\Package;

use App\Interfaces\V1\Package\PackageRepositoryInterface;
use App\Models\Package;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;

class PackageRepository implements PackageRepositoryInterface
{
    /**
     * getPackagesByType
     * @param string $type
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getPackagesByType(string $type): Collection
    {
        try {
            return Package::whereType($type)->get();
        }catch (Exception $e) {
            Log::error('PackageRepository::getPackageByType ', [$e->getMessage()]);
            throw $e;
        }
    }
}
