<?php

namespace App\Services\Api\V1\UserProfile;

use App\Interfaces\V1\UserProfile\UserProfileRepositoryInterface;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserProfileService
{
    /**
     * userProfileRepository
     * @var UserProfileRepositoryInterface
     */
    private UserProfileRepositoryInterface $userProfileRepository;
    private $user;

    /**
     * __construct
     * @param \App\Interfaces\V1\UserProfile\UserProfileRepositoryInterface $userProfileRepository
     */
    public function __construct(UserProfileRepositoryInterface $userProfileRepository)
    {
        $this->userProfileRepository = $userProfileRepository;
        $this->user = Auth::user();
    }

    /**
     * getAuthProfile
     * @return User
     */
    public function getAuthProfile(): User
    {
        try {
            return $this->userProfileRepository->showProfile($this->user->id);
        } catch (Exception $e) {
            Log::error('ServiceService::getList', ['error' => $e->getMessage()]);
            throw $e;
        }
    }

    /**
     * getUserProfile
     * @param \App\Models\User $user
     * @return User
     */
    public function getUserProfile(User $user): User
    {
        try {
            return $this->userProfileRepository->showProfile($user->id);
        } catch (Exception $e) {
            Log::error('ServiceService::getList', ['error' => $e->getMessage()]);
            throw $e;
        }
    }

    /**
     * updateUserProfile
     * @param array $data
     */
    public function updateUserProfile(array $data): void
    {
        try {
            $this->userProfileRepository->updateProfile($data, $this->user->id);
        } catch (Exception $e) {
            Log::error('ServiceService::updateUserProfile', ['error' => $e->getMessage()]);
            throw $e;
        }
    }

    /**
     * deleteUserProfile
     * @return void
     */
    public function deleteUserProfile()
    {
        try {
            $this->userProfileRepository->deleteProfile( $this->user->id);
        } catch (Exception $e) {
            Log::error('ServiceService::deleteUserProfile', ['error' => $e->getMessage()]);
            throw $e;
        }
    }
}
