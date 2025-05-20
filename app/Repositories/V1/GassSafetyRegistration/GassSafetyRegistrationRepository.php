<?php

namespace App\Repositories\V1\GassSafetyRegistration;

use App\Interfaces\V1\GassSafetyRegistration\GassSafetyRegistrationRepositoryInterface;
use App\Models\GasSafetyRegistration;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Log;

class GassSafetyRegistrationRepository implements GassSafetyRegistrationRepositoryInterface
{
    /**
     * createGSR
     * @param array $data
     * @param $frontUrl
     * @param $backUrl
     * @param \App\Models\User $user
     * @return GasSafetyRegistration
     */
    public function createGSR(array $data, $frontUrl, $backUrl, User $user): GasSafetyRegistration
    {
        try {
            return $user->gsr()->create([
                'number' => $data['gas_number'],
                'issue_date' => $data['gas_issue_date'],
                'expire_date' => $data['gas_expire_date'],
                'cart_front' => $frontUrl,
                'card_back' => $backUrl,
            ]);
        } catch (Exception $e) {
            Log::error('GassSafetyRegistrationRepository::createGSR', ['error' => $e->getMessage()]);
            throw $e;
        }
    }
}
