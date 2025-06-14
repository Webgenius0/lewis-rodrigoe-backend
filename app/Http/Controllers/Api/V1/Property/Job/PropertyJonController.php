<?php

namespace App\Http\Controllers\Api\V1\Property\Job;

use App\Http\Controllers\Api\V1\Controller;
use App\Http\Requests\Api\V1\Property\Job\CreateRequest;
use App\Http\Resources\Api\V1\Property\Job\CreateResource;
use App\Models\PropertyJob;
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
            return $this->success(200, ucfirst($status) . ' Job list', $response);
        } catch (Exception $e) {
            Log::error("PropertyController::index", ['message' => $e->getMessage()]);
            return $this->error(500, 'server error');
        }
    }

    /**
     *  pendingIndex
     * @return JsonResponse
     */
    public function pendingIndex(): JsonResponse
    {
        try {
            $response = $this->propertyJobService->getPendingtJobs();
            return $this->success(200, 'Job list', $response);
        } catch (Exception $e) {
            Log::error("PropertyController::pendingIndex", ['message' => $e->getMessage()]);
            return $this->error(500, 'server error');
        }
    }

    /**
     * engineerIndex
     * @param string $status
     * @return JsonResponse
     */
    public function engineerIndex(string $status): JsonResponse
    {
        try {
            $response = $this->propertyJobService->engineerJobsIndex($status);
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

    /**
     * show
     * @param \App\Models\PropertyJob $propertyJob
     * @return JsonResponse
     */
    public function show(PropertyJob $propertyJob): JsonResponse
    {
        try {
            $response = $this->propertyJobService->getJobDetails($propertyJob);
            return $this->success(200, 'Job details', $response);
        } catch (Exception $e) {
            Log::error("PropertyController::show", ['message' => $e->getMessage()]);
            return $this->error(500, 'server error');
        }
    }

    /**
     * status
     * @param \App\Models\PropertyJob $propertyJob
     * @param mixed $status
     * @return JsonResponse
     */
    public function status(PropertyJob $propertyJob, $status): JsonResponse
    {
        try {
            $propertyJob->status = $status;
            $propertyJob->save();
            return $this->success(200, 'Status updated');
        } catch (Exception $e) {
            Log::error("PropertyController::status", ['message' => $e->getMessage()]);
            return $this->error(500, 'server error');
        }
    }

    /**
     * assignEngineer
     * @param \App\Models\PropertyJob $propertyJob
     * @return JsonResponse
     */
    public function assignEngineer(PropertyJob $propertyJob): JsonResponse
    {
        try {
            $this->propertyJobService->assignEngineer($propertyJob);
            return $this->success(200, 'Engineer assigned successfully');
        } catch (Exception $e) {
            Log::error("PropertyController::assignEngineer", ['message' => $e->getMessage()]);
            return $this->error(500, 'server error');
        }
    }
}
