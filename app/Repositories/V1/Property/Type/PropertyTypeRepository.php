<?php

namespace App\Repositories\V1\Property\Type;

use App\Interfaces\V1\Property\Type\PropertyTypeRepositoryInterface;
use App\Models\PropertyType;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;

class PropertyTypeRepository implements PropertyTypeRepositoryInterface
{
    /**
     * getPropertyTypes
     * @return \Illuminate\Database\Eloquent\Collection<int, PropertyType>
     */
    public function getPropertyTypes(): Collection
    {
        try {
            return PropertyType::all();
        }catch(Exception $e) {
            Log::error('PropertyTypeRepository::getPropertyTypes', ['error' => $e->getMessage()]);
            throw $e;
        }
    }
}
