<?php

namespace App\Services\Api\V1\Service;

use App\Interfaces\V1\Service\ServiceRepositoryInterface;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;

class ServiceService
{
    private ServiceRepositoryInterface $serviceRepository;

    /**
     * construct
     * @param \App\Interfaces\V1\Service\ServiceRepositoryInterface $serviceRepository
     */
    public function __construct(ServiceRepositoryInterface $serviceRepository)
    {
        $this->serviceRepository = $serviceRepository;
    }

    /**
     * getList
     * @return \Illuminate\Database\Eloquent\Collection<int, \App\Models\Service>
     */
    public function getList(): Collection
    {
        try {
            return $this->serviceRepository->getList();
        } catch (Exception $e) {
            Log::error('ServiceService::getList', ['error' => $e->getMessage()]);
            throw $e;
        }
    }
}
