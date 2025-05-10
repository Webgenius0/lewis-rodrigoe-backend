<?php

namespace App\Interfaces\V1\Address;

use App\Models\Address;

interface AddressRepositoryInterface
{
    /**
     * create Address
     * @param array $data
     * @return Address
     */
    public function createAddress(array $data): Address;
}
