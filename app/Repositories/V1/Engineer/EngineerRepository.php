<?php

namespace App\Repositories\V1\Engineer;

use App\Interfaces\V1\Engineer\EngineerRepositoryInterface;
use App\Models\Engineer;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Log;

class EngineerRepository implements EngineerRepositoryInterface
{
    /**
     * createEngineer
     * @param array $data
     * @param int $addressId
     * @param \App\Models\User $user
     * @return Engineer
     */
    public function createEngineer(array $data, int $addressId, User $user): Engineer
    {
        try {
            return $user->engineer()->create([
                'expertise_id' => $data['expertise_id'],
                'address_id' => $addressId,
                'ni' => $data['ni'],
                'utr' => $data['utr'],
            ]);
        } catch (Exception $e) {
            Log::error('EngineerRepository::createEngineer', ['error' => $e->getMessage()]);
            throw $e;
        }
    }
}
