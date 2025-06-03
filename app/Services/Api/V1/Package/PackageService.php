<?php

namespace App\Services\Api\V1\Package;

use App\Interfaces\V1\Package\PackageRepositoryInterface;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;

class PackageService
{
    /**
     * packageRepository
     * @var PackageRepositoryInterface
     */
    private PackageRepositoryInterface $packageRepository;

    /**
     * __construct
     * @param \App\Interfaces\V1\Package\PackageRepositoryInterface $packageRepository
     */
    public function __construct(PackageRepositoryInterface $packageRepository)
    {
        $this->packageRepository = $packageRepository;
    }

    /**
     * getPackages
     * @param string $type
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getPackages(string $type): Collection
    {
        try {
            return $this->packageRepository->getPackagesByType($type);
        } catch (Exception $e) {
            Log::error('PackageService::getPackages', ['error' => $e->getMessage()]);
            throw $e;
        }
    }
}
