<?php

namespace App\Services\Web\V1\User;

use App\Interfaces\V1\UserProfile\UserProfileRepositoryInterface;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

class UserService
{
    /**
     * userProfileRepository
     * @var UserProfileRepositoryInterface
     */
    private UserProfileRepositoryInterface $userProfileRepository;

    /**
     * construct
     * @param \App\Interfaces\V1\UserProfile\UserProfileRepositoryInterface $userProfileRepository
     */
    public function __construct(UserProfileRepositoryInterface $userProfileRepository)
    {
        $this->userProfileRepository = $userProfileRepository;
    }

    /**
     * getClientList
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getClientList(): LengthAwarePaginator
    {
        try {
            $per_page = request()->input('per_page', 10);
            return $this->userProfileRepository->getUserListByRole(['owner', 'landlord'], $per_page);
        } catch (Exception $e) {
            Log::error('UserService::getClientList', [$e->getMessage()]);
            throw $e;
        }
    }
}
