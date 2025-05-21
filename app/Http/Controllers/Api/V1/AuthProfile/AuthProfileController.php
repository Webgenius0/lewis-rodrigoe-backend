<?php

namespace App\Http\Controllers\Api\V1\AuthProfile;

use App\Http\Controllers\Api\V1\Controller;
use App\Services\Api\V1\UserProfile\UserProfileService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AuthProfileController extends Controller
{
    /**
     * userProfileService
     * @var UserProfileService
     */
    private UserProfileService $userProfileService;

    /**
     * __construct
     * @param \App\Services\Api\V1\UserProfile\UserProfileService $userProfileService
     */
    public function __construct(UserProfileService $userProfileService)
    {
        $this->userProfileService = $userProfileService;
    }

    /**
     * show
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(): JsonResponse
    {
        try {
            $response = $this->userProfileService->getAuthProfile();
            return $this->success(200, 'auth profile', $response);
        }catch(Exception $e) {
            Log::error('ServiceService::getList', ['error' => $e->getMessage()]);
            return $this->error(500, 'server error', $e->getMessage());
        }
    }
}
