<?php

namespace App\Interfaces\V1\Property;

use App\Models\Property;

interface PropertyRepositoryInterface
{
    /**
     * createProperty
     * @param array $data
     * @param int $userId
     * @param int $addressId
     * @return Property
     */
    public function createProperty(array $data, int $userId, int $addressId): Property;



    /**
     * getUserPropertyAddressLabel
     * @param int $userId
     */
    public function getUserPropertyAddressLabel(int $userId);
}
