<?php

namespace App\Http\Controllers\Api\V1\Service;

use App\Http\Controllers\Api\V1\Controller;
use App\Services\Api\V1\Service\ServiceService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ServiceController extends Controller
{
    private ServiceService $serviceService;

    /**
     * construct
     * @param \App\Services\Api\V1\Service\ServiceService $serviceService
     */
    public function __construct(ServiceService $serviceService)
    {
        $this->serviceService = $serviceService;
    }

    /**
     * index
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $response = $this->serviceService->getList();
            return $this->success(200, 'service list', $response);
        }catch(Exception $e) {
            Log::error('ServiceController:index', [$e->getMessage()]);
            return $this->error(500, 'server error', $e->getMessage());
        }
    }
}
