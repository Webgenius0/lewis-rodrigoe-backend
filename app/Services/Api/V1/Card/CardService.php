<?php

namespace App\Services\Api\V1\Card;

use App\Interfaces\V1\Card\CardRepositoryInterface;
use App\Models\Card;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CardService
{
    /**
     * cardRepository
     * @var CardRepositoryInterface
     */
    private CardRepositoryInterface $cardRepository;
    private $user;
    /**
     * __construct
     * @param \App\Interfaces\V1\Card\CardRepositoryInterface $cardRepository
     */
    public function __construct(CardRepositoryInterface $cardRepository)
    {
        $this->user = Auth::user();
        $this->cardRepository = $cardRepository;
    }

    /**
     * storeCard
     * @param array $data
     * @return \App\Models\Card
     */
    public function storeCard(array $data): Card
    {
        try{
            return $this->cardRepository->storeCard($this->user->id, $data);
        }catch (Exception $e) {
            Log::error('CardService::storeCard', [$e->getMessage()]);
            throw $e;
        }
    }
}
