<?php

namespace App\Interfaces\V1\Property\Type;

use App\Models\PropertyType;
use Illuminate\Database\Eloquent\Collection;

interface PropertyTypeRepositoryInterface
{
    /**
     * getPropertyTypes
     * @return \Illuminate\Database\Eloquent\Collection<int, PropertyType>
     */
    public function getPropertyTypes(): Collection;

    /**
     * findPropertyType
     * @param int $id
     * @return PropertyType
     */
    public function findPropertyType(int $id): PropertyType;
}
