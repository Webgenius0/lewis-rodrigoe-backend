<?php

namespace App\Interfaces\V1\Property;

use App\Models\Property;

interface PropertyRepositoryInterface
{
    /**
     * getUserPropertyAddressLabel
     * @param int $userId
     */
    public function getUserPropertyAddressLabel(int $userId);

    /**
     * createProperty
     * @param array $data
     * @param int $userId
     * @param int $addressId
     * @return Property
     */
    public function createProperty(array $data, int $userId, int $addressId): Property;

    /**
     * updatePropertyBoiler
     * @param \App\Models\Property $property
     * @param array $data
     * @return void
     */
    public function updatePropertyBoiler(Property $property, array $data): void;

    /**
     * updatePropertyInfo
     * @param \App\Models\Property $property
     * @param array $data
     * @return void
     */
    public function updatePropertyInfo(Property $property, array $data): void;
}
