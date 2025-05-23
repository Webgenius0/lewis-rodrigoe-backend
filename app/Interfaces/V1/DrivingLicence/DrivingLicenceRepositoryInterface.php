<?php

namespace App\Interfaces\V1\DrivingLicence;

use App\Models\DrivingLicence;
use App\Models\User;
use Exception;

interface DrivingLicenceRepositoryInterface
{
    /**
     * createDrivingLicence
     * @param array $data
     * @param mixed $frontUrl
     * @param mixed $backUrl
     * @param \App\Models\User $user
     * @return DrivingLicence
     */
    public function createDrivingLicence(array $data, $frontUrl, $backUrl, User $user): DrivingLicence;

    /**
     * updateDrivingLicence
     * @param array $data
     * @param \App\Models\User $user
     * @throws Exception
     * @return void
     */
    public function updateDrivingLicence(array $data, User $user): void;
}
