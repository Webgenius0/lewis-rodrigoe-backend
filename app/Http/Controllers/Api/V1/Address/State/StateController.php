<?php

namespace App\Http\Controllers\Api\V1\Address\State;

use App\Http\Controllers\Api\V1\Controller;
use App\Services\Api\V1\Address\State\StateService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StateController extends Controller
{
    /**
     * stateService
     * @var StateService
     */
    private StateService $stateService;

    /**
     * __construct
     * @param \App\Services\Api\V1\Address\State\StateService $stateService
     */
    public function __construct(StateService $stateService)
    {
        $this->stateService = $stateService;
    }

    /**
     * index
     * @param mixed $country
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($country): JsonResponse
    {
        try {
            $resource = $this->stateService->getCountryStateIndex($country);
            return $this->success(200, 'state', $resource);
        } catch (Exception $e) {
            Log::error("StateController::index", ['message' => $e->getMessage()]);
            return $this->error(500, 'server error');
        }
    }
}
