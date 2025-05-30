<?php

namespace App\Http\Controllers\Api\V1\Property;

use App\Http\Controllers\Api\V1\Controller;
use App\Http\Requests\Api\V1\Property\CalculationRequest;
use App\Http\Requests\Api\V1\Property\CreateRequest;
use App\Http\Resources\Api\V1\Property\DropdownResource;
use App\Http\Resources\Api\V1\Property\StoreResource;
use App\Models\Property;
use App\Services\Api\V1\Property\PropertyService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use phpseclib3\Crypt\EC\Curves\prime192v1;

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
     * index
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $resource = $this->propertyService->getAllUserProperties();
            return $this->success(201, 'property created', $resource);
        } catch (Exception $e) {
            Log::error("PropertyController::index", ['message' => $e->getMessage()]);
            return $this->error(500, 'server error');
        }
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
            return $this->success(201, 'property created', new StoreResource($response));
        } catch (Exception $e) {
            Log::error("PropertyController::store", ['message' => $e->getMessage()]);
            return $this->error(500, 'server error');
        }
    }

    /**
     * userDropdown
     * @return JsonResponse
     */
    public function userDropdown(): JsonResponse
    {
        try {
            $response = $this->propertyService->userPropertyDropdown();
            return $this->success(200, 'users property', new DropdownResource($response));
        } catch (Exception $e) {
            Log::error("PropertyController::userDropdown", ['message' => $e->getMessage()]);
            return $this->error(500, 'server error');
        }
    }

    /**
     * show
     * @param \App\Models\Property $property
     * @return JsonResponse
     */
    public function show(Property $property): JsonResponse
    {
        try {
            $response = $this->propertyService->getPropertyDetails($property);
            return $this->success(200, 'users property', $response);
        } catch (Exception $e) {
            Log::error("PropertyController::show", ['message' => $e->getMessage()]);
            return $this->error(500, 'server error');
        }
    }

    /**
     * propertyCalculation
     * @param \App\Http\Requests\Api\V1\Property\CalculationRequest $calculationRequest
     * @return JsonResponse
     */
    public function propertyCalculation(CalculationRequest $calculationRequest): JsonResponse
    {
        try {
            $validatedData = $calculationRequest->validated();
            $resource = $this->propertyService->priceGeneration($validatedData);
            return $this->success(200, 'calculation successfull', $resource);
        } catch (Exception $e) {
            Log::error("PropertyController::userDropdown", ['message' => $e->getMessage()]);
            return $this->error(500, 'server error');
        }
    }
}
