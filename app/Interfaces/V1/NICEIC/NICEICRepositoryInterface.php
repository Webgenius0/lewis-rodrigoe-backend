<?php

namespace App\Interfaces\V1\NICEIC;

use App\Models\NICEIC;
use App\Models\User;

interface NICEICRepositoryInterface
{
    /**
     * createNICEIC
     * @param array $data
     * @param mixed $frontUrl
     * @param mixed $backUrl
     * @param \App\Models\User $user
     * @return NICEIC
     */
    public function createNICEIC(array $data, $frontUrl, $backUrl, User $user): NICEIC;
}
