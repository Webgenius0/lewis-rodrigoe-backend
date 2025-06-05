<?php

namespace App\Interfaces\V1\Card;

use App\Models\Card;

interface CardRepositoryInterface
{
    /**
     * storeCard
     * @param int $userId
     * @param array $data
     * @return Card
     */
    public function storeCard(int $userId, array $data): Card;
}
