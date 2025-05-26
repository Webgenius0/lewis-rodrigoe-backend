<?php

namespace App\Http\Controllers\Api\V1\OnlineHoiur;

use App\Http\Controllers\Api\V1\Controller;
use App\Models\OnlineHour;
use App\Services\Api\V1\OnlineHoiur\OnlineHourService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OnlineHourController extends Controller
{
    /**
     * onlineHourService
     * @var OnlineHourService
     */
    private OnlineHourService $onlineHourService;
    /**
     * construct
     * @param \App\Services\Api\V1\OnlineHoiur\OnlineHourService $onlineHourService
     */
    public function __construct(OnlineHourService $onlineHourService)
    {
        $this->onlineHourService = $onlineHourService;
    }

    /**
     * index
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $onlineHours = $this->onlineHourService->getOnlineHours();
            return $this->success(200, 'Online hours retrieved successfully', $onlineHours);
        } catch (Exception $e) {
            Log::error('OnlineHourController::index ', [$e->getMessage()]);
            return $this->error(500, 'An error occurred while retrieving online hours', $e->getMessage());
        }
    }
}
