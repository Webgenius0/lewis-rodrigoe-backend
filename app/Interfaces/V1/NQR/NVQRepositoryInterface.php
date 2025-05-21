<?php

namespace App\Interfaces\V1\NQR;

use App\Models\NVQQualification;
use App\Models\User;

interface NVQRepositoryInterface
{
    /**
     * createNICEIC
     * @param array $data
     * @param \App\Models\User $user
     * @param string $level_one
     * @param mixed $level_tow
     * @return NVQQualification
     */
    public function createNICEIC(array $data, User $user, string $level_one, $level_tow = null): NVQQualification;
}
