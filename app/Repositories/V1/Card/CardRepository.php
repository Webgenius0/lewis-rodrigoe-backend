<?php

namespace App\Repositories\V1\Card;

use App\Interfaces\V1\Card\CardRepositoryInterface;
use App\Models\Card;
use Exception;
use Illuminate\Support\Facades\Log;

class CardRepository implements CardRepositoryInterface
{
    /**
     * storeCard
     * @param int $userId
     * @param array $data
     * @return Card
     */
    public function storeCard(int $userId, array $data): Card
    {
        try {
            return Card::create([
                'user_id' => $userId,
                'name'    => $data['name'],
                'number'  => $data['number'],
                'cvv'     => $data['cvv'],
                'date'    => $data['date'],

            ]);
        } catch (Exception $e) {
            Log::info('CardRepository:storeCard', [$e->getMessage()]);
            throw $e;
        }
    }
}
