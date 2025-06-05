<?php

namespace App\Http\Controllers\Api\V1\Card;

use App\Http\Controllers\Api\V1\Controller;
use App\Http\Requests\Api\V1\Card\StoreRequest;
use App\Models\Card;
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

    /**
     * show
     * @param \App\Models\Card $card
     * @return JsonResponse
     */
    public function show(Card $card): JsonResponse
    {
        try {
            return $this->success(200, 'card created', $card);
        }catch(Exception $e) {
                        Log::error('CardController::show', [$e->getMessage()]);
            return $this->error(500, 'server error', $e->getMessage());
        }
    }
}
