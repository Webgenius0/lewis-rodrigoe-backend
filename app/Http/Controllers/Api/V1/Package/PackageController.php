<?php

namespace App\Http\Controllers\Api\V1\Package;

use App\Http\Controllers\Api\V1\Controller;
use App\Services\Api\V1\Package\PackageService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PackageController extends Controller
{
    /**
     * packageService
     * @var PackageService
     */
    private PackageService $packageService;

    /**
     * construct
     * @param \App\Services\Api\V1\Package\PackageService $packageService
     */
    public function __construct(PackageService $packageService)
    {
        $this->packageService = $packageService;
    }

    public function index($type): JsonResponse
    {
        try {
            $resource = $this->packageService->getPackages($type);
            return $this->success(200, 'package list', $resource);
        } catch (Exception $e) {
            Log::error("PackageController::index", ['message' => $e->getMessage()]);
            return $this->error(500, 'server error');
        }
    }
}
