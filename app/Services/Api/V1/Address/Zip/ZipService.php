<?php

namespace App\Services\Api\V1\Address\Zip;

use App\Interfaces\V1\Address\Zip\ZipRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\Log;

class ZipService
{
    /**
     * zipRepository
     * @var ZipRepositoryInterface
     */
    private ZipRepositoryInterface $zipRepository;

    /**
     * __construct
     * @param \App\Interfaces\V1\Address\Zip\ZipRepositoryInterface $zipRepository
     */
    public function __construct(ZipRepositoryInterface $zipRepository)
    {
        $this->zipRepository = $zipRepository;
    }

    /**
     * getCityZipIndex
     * @param mixed $cityId
     */
    public function getCityZipIndex($cityId): mixed
    {
        try {
            return $this->zipRepository->getCityZips($cityId);
        } catch (Exception $e) {
            Log::error('ZipService::getCityZipIndex', ['error' => $e->getMessage()]);
            throw $e;
        }
    }
}
