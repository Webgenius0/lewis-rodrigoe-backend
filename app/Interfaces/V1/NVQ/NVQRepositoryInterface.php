<?php

namespace App\Interfaces\V1\NVQ;

use App\Models\NVQQualification;
use App\Models\User;

interface NVQRepositoryInterface
{
    /**
     * createNVQ
     * @param array $data
     * @param \App\Models\User $user
     * @param string $level_one
     * @param mixed $level_tow
     * @return NVQQualification
     */
    public function createNVQ(array $data, User $user, $level_one, $level_tow = null):NVQQualification;
}
