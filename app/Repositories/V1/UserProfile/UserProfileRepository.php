<?php

namespace App\Repositories\V1\UserProfile;

use App\Helpers\Helper;
use App\Interfaces\V1\UserProfile\UserProfileRepositoryInterface;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
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
            return User::with(['profile', 'role'])->findOrFail($userId);
        } catch (Exception $e) {
            Log::error('UserProfileRepository::showProfile', ['error' => $e->getMessage()]);
            throw $e;
        }
    }

    /**
     * updateProfile
     * @param array $data
     * @param int $userId
     * @return void
     */
    public function updateProfile(array $data, int $userId): void
    {
        $uploadedAvatarPath = null;
        $oldAvatarToDelete = null;

        try {
            DB::beginTransaction();

            $user = User::findOrFail($userId);

            // Upload new avatar if provided
            if (isset($data['avatar'])) {
                $uploadedAvatarPath = Helper::uploadFile($data['avatar'], 'avatar');
                if ($user->avatar) {
                    $oldAvatarToDelete = $user->avatar;
                }
            }

            // Update user info
            $user->update([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'avatar' => $uploadedAvatarPath ?? $user->avatar,
            ]);

            // Update profile info
            $user->profile()->update([
                'phone' => $data['phone'],
                'gender' => $data['gender'],
            ]);

            DB::commit();

            if ($oldAvatarToDelete) {
                Helper::deleteFile($oldAvatarToDelete);
            }
        } catch (Exception $e) {
            DB::rollBack();
            if ($uploadedAvatarPath) {
                Helper::deleteFile($uploadedAvatarPath);
            }

            Log::error('UserProfileRepository::updateProfile', ['error' => $e->getMessage()]);
            throw $e;
        }
    }
}
