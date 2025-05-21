<?php

namespace App\Repositories\V1\NQR;

use App\Interfaces\V1\NQR\NVQRepositoryInterface;
use App\Models\NVQQualification;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Log;

class NVQRepository implements NVQRepositoryInterface
{
    /**
     * createNICEIC
     * @param array $data
     * @param \App\Models\User $user
     * @param string $level_one
     * @param mixed $level_tow
     * @return NVQQualification
     */
    public function createNICEIC(array $data, User $user, string $level_one, $level_tow = null):NVQQualification
    {
        try {
            return $user->nvq()->create([
                'number' => $data['nvq_number'],
                'level_one' => $level_one,
                'level_two' => $level_tow,
            ]);
        } catch (Exception $e) {
            Log::error('NICEICRepository::createNICEIC', ['error' => $e->getMessage()]);
            throw $e;
        }
    }
}
