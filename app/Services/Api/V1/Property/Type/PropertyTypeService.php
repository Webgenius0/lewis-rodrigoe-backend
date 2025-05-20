<?php

namespace App\Services\Api\V1\Property\Type;

use App\Interfaces\V1\Property\Type\PropertyTypeRepositoryInterface;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;

class PropertyTypeService
{
    /**
     * propertyTypeRepository
     * @var PropertyTypeRepositoryInterface
     */
    private PropertyTypeRepositoryInterface $propertyTypeRepository;

    /**
     * __construct
     * @param \App\Interfaces\V1\Property\Type\PropertyTypeRepositoryInterface $propertyTypeRepository
     */
    public function __construct(PropertyTypeRepositoryInterface $propertyTypeRepository)
    {
        $this->propertyTypeRepository = $propertyTypeRepository;
    }

    /**
     * getPropertyTypeIndex
     * @return \Illuminate\Database\Eloquent\Collection<int, \App\Models\PropertyType>
     */
    public function getPropertyTypeIndex(): Collection
    {
        try {
            return $this->propertyTypeRepository->getPropertyTypes();
        } catch (Exception $e) {
            Log::error('PropertyTypeService::getPropertyTypeIndex', ['error' => $e->getMessage()]);
            throw $e;
        }
    }
}
