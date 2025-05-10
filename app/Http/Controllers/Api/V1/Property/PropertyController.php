<?php

namespace App\Http\Controllers\Api\V1\Property;

use App\Http\Controllers\Api\V1\Controller;
use App\Http\Requests\Api\V1\Property\CreateRequest;
use App\Services\Api\V1\Property\PropertyService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PropertyController extends Controller
{
    /**
     * propertyService
     * @var PropertyService
     */
    private PropertyService $propertyService;

    /**
     * construct
     * @param \App\Services\Api\V1\Property\PropertyService $propertyService
     */
    public function __construct(PropertyService $propertyService)
    {
        $this->propertyService = $propertyService;
    }

    /**
     * store
     * @param \App\Http\Requests\Api\V1\Property\CreateRequest $createRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateRequest $createRequest): JsonResponse
    {
        try {
            $validatedData = $createRequest->validated();
            $response = $this->propertyService->createUserProperty($validatedData);
            return $this->success(201, 'property created', $response);
        } catch (Exception $e) {
            Log::error("PropertyController::store", ['message' => $e->getMessage()]);
            return $this->error(500, 'server error');
        }
    }
}
