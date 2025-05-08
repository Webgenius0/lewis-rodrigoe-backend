<?php

namespace App\Repositories\V1\Service;

use App\Interfaces\V1\Service\ServiceRepositoryInterface;
use App\Models\Service;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;

class ServiceRepository implements ServiceRepositoryInterface
{
    /**
     * getList
     * @return \Illuminate\Database\Eloquent\Collection<int, Service>
     */
    public function getList(): Collection
    {
        try {
            return Service::all();
        }catch (Exception $e) {
            Log::error('ServiceRepository::getList', ['error' => $e->getMessage()]);
            throw $e;
        }
    }

}
