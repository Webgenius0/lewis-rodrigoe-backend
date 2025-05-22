<?php

namespace App\Repositories\V1\DrivingLicence;

use App\Helpers\Helper;
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

    /**
     * updateDrivingLicence
     * @param array $data
     * @param \App\Models\User $user
     * @throws Exception
     * @return void
     */
    public function updateDrivingLicence(array $data, User $user): void
    {
        try {
            $drivingLicence = $user->drivingLicence;

            if (!$drivingLicence) {
                throw new Exception('Driving licence record not found.');
            }

            if (isset($data['cart_front'])) {
                $data['cart_front'] = Helper::uploadFile($data['cart_front'], 'drivingLicence');
            }

            if (isset($data['card_back'])) {
                $data['card_back'] = Helper::uploadFile($data['card_back'], 'drivingLicence');
            }

            $drivingLicence->update([
                'number'      => $data['number'],
                'issue_date'  => $data['issue_date'],
                'expire_date' => $data['expire_date'],
                'cart_front'  => $data['cart_front'] ?? $drivingLicence->cart_front,
                'card_back'   => $data['card_back'] ?? $drivingLicence->card_back,
            ]);
        } catch (Exception $e) {
            Log::error('DrivingLicenceRepository::updateDrivingLicence', ['error' => $e->getMessage()]);
            throw $e;
        }
    }
}
