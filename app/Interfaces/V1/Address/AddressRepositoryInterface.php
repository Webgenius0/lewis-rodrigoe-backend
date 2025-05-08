<?php

namespace App\Interfaces\V1\Address;

interface AddressRepositoryInterface
{
    /**
     * create
     * @param array $data
     */
    public function create(array $data);
}
