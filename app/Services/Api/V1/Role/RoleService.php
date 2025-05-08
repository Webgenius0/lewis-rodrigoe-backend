<?php

namespace App\Services\Api\V1\Role;

use App\Interfaces\V1\Role\RoleRepositoryInterface;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;

class RoleService
{
    private RoleRepositoryInterface $roleRepository;

    /**
     * construct
     * @param \App\Interfaces\V1\Role\RoleRepositoryInterface $roleRepository
     */
    public function __construct(RoleRepositoryInterface $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    /**
     * getList
     * @return \Illuminate\Database\Eloquent\Collection<int, \App\Models\Role>
     */
    public function getList(): Collection
    {
        try {
            return $this->roleRepository->getList();
        }catch(Exception $e) {
            Log::error('RoleService::getList', ['error' => $e->getMessage()]);
            throw $e;
        }
    }
}
