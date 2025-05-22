<?php

namespace App\Http\Controllers\Api\V1\Property\Job;

use App\Http\Controllers\Api\V1\Controller;
use App\Http\Requests\Api\V1\Property\Job\CreateRequest;
use App\Http\Resources\Api\V1\Property\Job\CreateResource;
use App\Services\Api\V1\Property\Job\PropertyJobService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PropertyJonController extends Controller
{
    /**
     * propertyJobService
     * @var PropertyJobService
     */
    private PropertyJobService $propertyJobService;

    /**
     * __construct
     * @param \App\Services\Api\V1\Property\Job\PropertyJobService $propertyJobService
     */
    public function __construct(PropertyJobService $propertyJobService)
    {
        $this->propertyJobService = $propertyJobService;
    }

    /**
     * index
     * @param string $status
     * @return JsonResponse
     */
    public function index(string $status): JsonResponse
    {
        try {
            $response = $this->propertyJobService->propertyJobIndex($status);
            return $this->success(200, 'Job list', $response);
        } catch (Exception $e) {
            Log::error("PropertyController::index", ['message' => $e->getMessage()]);
            return $this->error(500, 'server error');
        }
    }

    /**
     * store
     * @param \App\Http\Requests\Api\V1\Property\Job\CreateRequest $createRequest
     * @return JsonResponse
     */
    public function store(CreateRequest $createRequest): JsonResponse
    {
        try {
            $validatedData = $createRequest->validated();
            $response = $this->propertyJobService->createJobforProperty($validatedData);
            return $this->success(201, 'Job Created', new CreateResource($response));
        } catch (Exception $e) {
            Log::error("PropertyController::store", ['message' => $e->getMessage()]);
            return $this->error(500, 'server error');
        }
    }
}
