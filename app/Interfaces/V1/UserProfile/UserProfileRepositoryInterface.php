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

    /**
     * updateProfile
     * @param array $data
     * @param int $userId
     * @return void
     */
    public function updateProfile(array $data, int $userId): void;

    /**
     * deleteProfile
     * @param int $userId
     * @return void
     */
    public function deleteProfile(int $userId): void;
}
