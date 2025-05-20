<?php

namespace App\Interfaces\V1\GassSafetyRegistration;

use App\Models\GasSafetyRegistration;
use App\Models\User;

interface GassSafetyRegistrationRepositoryInterface
{
    /**
     * createGSR
     * @param array $data
     * @param $frontUrl
     * @param $backUrl
     * @param \App\Models\User $user
     * @return GasSafetyRegistration
     */
    public function createGSR(array $data, $frontUrl, $backUrl, User $user): GasSafetyRegistration;
}
