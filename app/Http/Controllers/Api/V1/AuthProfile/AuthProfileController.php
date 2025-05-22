<?php

namespace App\Http\Controllers\Api\V1\AuthProfile;

use App\Http\Controllers\Api\V1\Controller;
use App\Http\Requests\Api\V1\Profile\UpdateRequest;
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
     * dashboard
     * @return JsonResponse
     */
    public function dashboard(): JsonResponse
    {
        try {
            $response = $this->userProfileService->getProfileDashboard();
            return $this->success(200, 'auth profile', $response);
        }catch(Exception $e) {
            Log::error('AuthProfileController::dashboard', ['error' => $e->getMessage()]);
            return $this->error(500, 'server error', $e->getMessage());
        }
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
        } catch (Exception $e) {
            Log::error('AuthProfileController::show', ['error' => $e->getMessage()]);
            return $this->error(500, 'server error', $e->getMessage());
        }
    }

    /**
     * update
     * @param \App\Http\Requests\Api\V1\Profile\UpdateRequest $updateRequest
     * @return JsonResponse
     */
    public function update(UpdateRequest $updateRequest): JsonResponse
    {
        try {
            $validatedData = $updateRequest->validated();
            $this->userProfileService->updateUserProfile($validatedData);
            return $this->success(200, 'update successfull');
        } catch (Exception $e) {
            Log::error('AuthProfileController::update', ['error' => $e->getMessage()]);
            return $this->error(500, 'server error', $e->getMessage());
        }
    }

    /**
     * destory
     * @return JsonResponse
     */
    public function destory(): JsonResponse
    {
        try {
            $this->userProfileService->deleteUserProfile();
            return $this->success(200, 'deleted successfully');
        } catch (Exception $e) {
            Log::error('AuthProfileController::destory', ['error' => $e->getMessage()]);
            return $this->error(500, 'server error', $e->getMessage());
        }
    }
}
