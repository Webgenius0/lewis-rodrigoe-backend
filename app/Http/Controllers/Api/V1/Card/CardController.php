<?php

namespace App\Http\Controllers\Api\V1\Card;

use App\Http\Controllers\Api\V1\Controller;
use App\Http\Requests\Api\V1\Card\StoreRequest;
use App\Services\Api\V1\Card\CardService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CardController extends Controller
{
    /**
     * cardService
     * @var CardService
     */
    private CardService $cardService;
    /**
     * construct
     * @param \App\Services\Api\V1\Card\CardService $cardService
     */
    public function __construct(CardService $cardService)
    {
        $this->cardService = $cardService;
    }

    /**
     * store
     * @param \App\Http\Requests\Api\V1\Card\StoreRequest $storeRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreRequest $storeRequest): JsonResponse
    {
        try {
            $validatedData = $storeRequest->validated();
            $response = $this->cardService->storeCard($validatedData);
            return $this->success(201, 'card created', $response);
        }catch (Exception $e) {
            Log::error('CardController::store', [$e->getMessage()]);
            return $this->error(500, 'server error', $e->getMessage());
        }
    }
}
