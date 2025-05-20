<?php

namespace App\Repositories\V1\Boiler\Model;

use App\Interfaces\V1\Boiler\Model\BoilerModelRepositoryInterface;
use App\Models\BoilerModel;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;

class BoilerModelRepository implements BoilerModelRepositoryInterface
{
    /**
     * getBoilerModels
     * @return \Illuminate\Database\Eloquent\Collection<int, BoilerModel>
     */
    public function getBoilerModels(): Collection
    {
        try {
            return BoilerModel::all();
        } catch (Exception $e) {
            Log::error('BoilerModelRepository::getBoilerModels', ['error' => $e->getMessage()]);
            throw $e;
        }
    }
}
