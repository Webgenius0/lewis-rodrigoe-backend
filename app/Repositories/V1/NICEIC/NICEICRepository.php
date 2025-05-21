<?php

namespace App\Repositories\V1\NICEIC;

use App\Interfaces\V1\NICEIC\NICEICRepositoryInterface;
use App\Models\NICEIC;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Log;

class NICEICRepository implements NICEICRepositoryInterface
{
    /**
     * createNICEIC
     * @param array $data
     * @param mixed $frontUrl
     * @param mixed $backUrl
     * @param \App\Models\User $user
     * @return NICEIC
     */
    public function createNICEIC(array $data, $frontUrl, $backUrl, User $user): NICEIC
    {
        try {
            return $user->niceic()->create([
                'number' => $data['nic_eic_number'],
                'issue_date' => $data['nic_eic_issue_date'],
                'expire_date' => $data['nic_eic_expire_date'],
                'cart_front' => $frontUrl,
                'card_back' => $backUrl,
            ]);
        } catch (Exception $e) {
            Log::error('NICEICRepository::createNICEIC', ['error' => $e->getMessage()]);
            throw $e;
        }
    }
}
