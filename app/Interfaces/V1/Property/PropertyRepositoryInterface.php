<?php

namespace App\Interfaces\V1\Property;

interface PropertyRepositoryInterface
{
    /**
     * createProperty
     * @param array $data
     * @param int $userId
     * @param int $addressId
     */
    public function createProperty(array $data, int $userId, int $addressId);
}
