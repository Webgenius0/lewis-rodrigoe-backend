<?php

namespace App\Http\Controllers\Api\V1\Boiler\Model;

use App\Http\Controllers\Api\V1\Controller;
use App\Services\Api\V1\Boiler\Model\BoilerModelService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BoilerModelController extends Controller
{
    /**
     * boilerModelService
     * @var BoilerModelService
     */
    private BoilerModelService $boilerModelService;

    /**
     * __construct
     * @param \App\Services\Api\V1\Boiler\Model\BoilerModelService $boilerModelService
     */
    public function __construct(BoilerModelService $boilerModelService)
    {
        $this->boilerModelService = $boilerModelService;
    }

    /**
     * index
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $response = $this->boilerModelService->getBoilerModelIndex();
            return $this->success(200, 'boiler model list', $response);
        } catch (Exception $e) {
            Log::error("BoilerModelController::index", ['message' => $e->getMessage()]);
            return $this->error(500, 'server error');
        }
    }
}
