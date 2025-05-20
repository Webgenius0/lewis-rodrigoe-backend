<?php

namespace App\Http\Controllers\Api\V1\Boiler\Type;

use App\Http\Controllers\Api\V1\Controller;
use App\Services\Api\V1\Boiler\Type\BoilerTypeService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BoilerTypeController extends Controller
{
    /**
     * boilerTypeService
     * @var BoilerTypeService
     */
    private BoilerTypeService $boilerTypeService;

    /**
     * __construct
     * @param \App\Services\Api\V1\Boiler\Type\BoilerTypeService $boilerTypeService
     */
    public function __construct(BoilerTypeService $boilerTypeService)
    {
        $this->boilerTypeService = $boilerTypeService;
    }

    /**
     * index
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $resource = $this->boilerTypeService->boilerTypeIndex();
            return $this->success(200, 'boiler type list', $resource);
        } catch (Exception $e) {
            Log::error("BoilerTypeController::index", ['message' => $e->getMessage()]);
            return $this->error(500, 'server error');
        }
    }
}
