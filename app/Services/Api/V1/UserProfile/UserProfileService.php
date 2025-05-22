<?php

namespace App\Services\Api\V1\UserProfile;

use App\Interfaces\V1\Property\Job\PropertyJobRepositoryInterface;
use App\Interfaces\V1\Property\PropertyRepositoryInterface;
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
    private PropertyJobRepositoryInterface $propertyJobRepository;
    private $user;

    /**
     * __construct
     * @param \App\Interfaces\V1\UserProfile\UserProfileRepositoryInterface $userProfileRepository
     * @param \App\Interfaces\V1\Property\Job\PropertyJobRepositoryInterface $propertyJobRepository
     */
    public function __construct(UserProfileRepositoryInterface $userProfileRepository, PropertyJobRepositoryInterface $propertyJobRepository)
    {
        $this->userProfileRepository = $userProfileRepository;
        $this->propertyJobRepository = $propertyJobRepository;
        $this->user = Auth::user();
    }

    /**
     * getProfiledashboard
     * @return array{completed_job: int, pending_job: int, user: User}
     */
    public function getProfileDashboard(): array
    {
        try {
            $profile = $this->userProfileRepository->showProfile($this->user->id, ['profile']);

            $pendingJobCount = $this->propertyJobRepository->JobCount('user_id', $this->user->id, 'pending');
            $completedJobCount = $this->propertyJobRepository->JobCount('user_id', $this->user->id, 'completed');

            return [
                'user' => $profile,
                'pending_job' => $pendingJobCount,
                'completed_job' => $completedJobCount,
            ];

        } catch (Exception $e) {
            Log::error('ServiceService::getProfiledashboard', ['error' => $e->getMessage()]);
            throw $e;
        }
    }

    /**
     * getAuthProfile
     * @return User
     */
    public function getAuthProfile(): User
    {
        try {
            return $this->userProfileRepository->showProfile($this->user->id, ['profile', 'role']);
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
            return $this->userProfileRepository->showProfile($user->id, ['profile', 'role']);
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
            $this->userProfileRepository->deleteProfile($this->user->id);
        } catch (Exception $e) {
            Log::error('ServiceService::deleteUserProfile', ['error' => $e->getMessage()]);
            throw $e;
        }
    }
}
