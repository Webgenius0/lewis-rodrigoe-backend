<?php

namespace App\Http\Controllers\Api\V1\Address\Zip;

use App\Http\Controllers\Api\V1\Controller;
use App\Services\Api\V1\Address\Zip\ZipService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ZipController extends Controller
{
    /**
     * zipService
     * @var ZipService
     */
    private ZipService $zipService;

    /**
     * __construct
     * @param \App\Services\Api\V1\Address\Zip\ZipService $zipService
     */
    public function __construct(ZipService $zipService)
    {
        $this->zipService = $zipService;
    }

    /**
     * index
     * @param mixed $city
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($city): JsonResponse
    {
        try {
            $resource = $this->zipService->getCityZipIndex($city);
            return $this->success(200, 'state', $resource);
        } catch (Exception $e) {
            Log::error("ZipController::index", ['message' => $e->getMessage()]);
            return $this->error(500, 'server error');
        }
    }
}
