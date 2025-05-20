<?php

namespace App\Http\Controllers\Api\V1\Property\Type;

use App\Http\Controllers\Api\V1\Controller;
use App\Services\Api\V1\Property\Type\PropertyTypeService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PropertyTypeController extends Controller
{
    /**
     * propertyTypeService
     * @var PropertyTypeService
     */
    private PropertyTypeService $propertyTypeService;

    /**
     * __construct
     * @param \App\Services\Api\V1\Property\Type\PropertyTypeService $propertyTypeService
     */
    public function __construct(PropertyTypeService $propertyTypeService)
    {
        $this->propertyTypeService = $propertyTypeService;
    }

    /**
     * index
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $response = $this->propertyTypeService->getPropertyTypeIndex();
            return $this->success(200, 'property type list', $response);
        } catch (Exception $e) {
            Log::error("PropertyTypeController::index", ['message' => $e->getMessage()]);
            return $this->error(500, 'server error');
        }
    }
}
