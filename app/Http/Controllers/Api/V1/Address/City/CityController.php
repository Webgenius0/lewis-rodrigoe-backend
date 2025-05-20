<?php

namespace App\Http\Controllers\Api\V1\Address\City;

use App\Http\Controllers\Api\V1\Controller;
use App\Services\Api\V1\Address\City\CityService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CityController extends Controller
{
    /**
     * cityService
     * @var CityService
     */
    private CityService $cityService;

    /**
     * construct
     * @param \App\Services\Api\V1\Address\City\CityService $cityService
     */
    public function __construct(CityService $cityService)
    {
        $this->cityService = $cityService;
    }

    /**
     * index
     * @param mixed $state
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($state): JsonResponse
    {
        try {
            $response = $this->cityService->getStateCitiesIndex($state);
            return $this->success(200, 'city list', $response);
        } catch (Exception $e) {
            Log::error("CityController::index", ['message' => $e->getMessage()]);
            return $this->error(500, 'server error');
        }
    }
}
