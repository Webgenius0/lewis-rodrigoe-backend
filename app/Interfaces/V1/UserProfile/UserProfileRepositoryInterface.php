<?php

namespace App\Interfaces\V1\UserProfile;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

interface UserProfileRepositoryInterface
{
    /**
     * getUserListByRole
     * @param array $roles
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getUserListByRole(array $roles, int $perPage): LengthAwarePaginator;

    /**
     * showProfile
     * @param int $userId
     * @param array $load
     * @return User
     */
    public function showProfile(int $userId, array $load = []): User;

    /**
     * updateProfile
     * @param array $data
     * @param int $userId
     * @return void
     */
    public function updateProfile(array $data, int $userId): void;

    /**
     * updatePassword
     * @param int $authId
     * @param array $data
     * @return void
     */
    public function updatePassword(int $authId, array $data): void;
    
    /**
     * deleteProfile
     * @param int $userId
     * @return void
     */
    public function deleteProfile(int $userId): void;
}
