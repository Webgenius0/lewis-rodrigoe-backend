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
    public function __construct(UserProfileRepositoryInterface $userProfileRepository) {
        $this->userProfileRepository = $userProfileRepository;
        $this->user = Auth::user();
    }

    /**
     * getProfile
     * @return User
     */
    public function getProfile():User
    {
        try {
            return $this->userProfileRepository->showProfile($this->user->id);
        } catch (Exception $e) {
            Log::error('ServiceService::getList', ['error' => $e->getMessage()]);
            throw $e;
        }
    }
}
