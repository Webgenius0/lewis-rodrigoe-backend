<?php

namespace App\Interfaces\V1\Engineer;

use App\Models\Engineer;
use App\Models\User;

interface EngineerRepositoryInterface
{
    /**
     * createEngineer
     * @param array $data
     * @param int $addressId
     * @param \App\Models\User $user
     * @return Engineer
     */
    public function createEngineer(array $data, int $addressId, User $user): Engineer;
}
