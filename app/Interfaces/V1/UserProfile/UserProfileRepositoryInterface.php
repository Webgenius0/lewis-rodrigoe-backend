<?php

namespace App\Interfaces\V1\UserProfile;

use App\Models\User;

interface UserProfileRepositoryInterface
{
    /**
     * showProfile
     * @param int $userId
     * @return User
     */
    public function showProfile(int $userId): User;
}
