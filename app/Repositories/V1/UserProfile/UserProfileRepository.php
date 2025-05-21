<?php

namespace App\Repositories\V1\UserProfile;

use App\Interfaces\V1\UserProfile\UserProfileRepositoryInterface;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Log;

class UserProfileRepository implements UserProfileRepositoryInterface
{
    /**
     * showProfile
     * @param int $userId
     * @return User
     */
    public function showProfile(int $userId): User
    {
        try {
            Log::info('show repo');
            return User::with(['profile', 'role'])->findOrFail($userId);
        } catch (Exception $e) {
            Log::error('UserProfileRepository::showProfile', ['error' => $e->getMessage()]);
            throw $e;
        }
    }
}
