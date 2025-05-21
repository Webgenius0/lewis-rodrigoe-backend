<?php

namespace App\Repositories\V1\DrivingLicence;

use App\Interfaces\V1\DrivingLicence\DrivingLicenceRepositoryInterface;
use App\Models\DrivingLicence;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Log;

class DrivingLicenceRepository implements DrivingLicenceRepositoryInterface
{
    /**
     * createDrivingLicence
     * @param array $data
     * @param mixed $frontUrl
     * @param mixed $backUrl
     * @param \App\Models\User $user
     * @return DrivingLicence
     */
    public function createDrivingLicence(array $data, $frontUrl, $backUrl, User $user): DrivingLicence
    {
        try {
            return $user->drivingLicence()->create([
                'number' => $data['driving_licence_number'],
                'issue_date' => $data['driving_licence_issue_date'],
                'expire_date' => $data['driving_licence_expire_date'],
                'cart_front' => $frontUrl,
                'card_back' => $backUrl,
            ]);
        } catch (Exception $e) {
            Log::error('DrivingLicenceRepository::createDrivingLicence', ['error' => $e->getMessage()]);
            throw $e;
        }
    }
}
