<?php

namespace App\Repositories\V1\Boiler\Type;

use App\Interfaces\V1\Boiler\Type\BoilerTypeRepositoryInterface;
use App\Models\BoilerTypes;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;

class BoilerTypeRepository implements BoilerTypeRepositoryInterface
{
    /**
     * getBoilerTypes
     * @return \Illuminate\Database\Eloquent\Collection<int, BoilerTypes>
     */
    public function getBoilerTypes(): Collection
    {
        try {
            return BoilerTypes::all();
        } catch (Exception $e) {
            Log::error('BoilerTypeRepository::getBoilerTypes', ['error' => $e->getMessage()]);
            throw $e;
        }
    }
}
