<?php

namespace App\Services\Api\V1\Property;

use App\Interfaces\V1\Property\PropertyRepositoryInterface;

class PropertyService
{
    /**
     * propertyRepository
     * @var PropertyRepositoryInterface
     */
    private PropertyRepositoryInterface $propertyRepository;

    /**
     * construct
     * @param \App\Interfaces\V1\Property\PropertyRepositoryInterface $propertyRepository
     */
    public function __construct(PropertyRepositoryInterface $propertyRepository)
    {
        $this->propertyRepository = $propertyRepository;
    }
}
