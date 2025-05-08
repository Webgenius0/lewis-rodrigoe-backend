<?php

namespace App\Repositories\Api\V1\Role;

use App\Interfaces\Api\V1\Role\RoleRepositoryInterface;
use App\Models\Role;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;

class RoleRepository implements RoleRepositoryInterface
{
    /**
     * getList
     * @return \Illuminate\Database\Eloquent\Collection<int, Role>
     */
    public function getList(): Collection
    {
        try {
            $data = Role::select(['id', 'name'])->all();
            return $data;
        } catch (Exception $e) {
            Log::error('RoleRepository::getList', ['error' => $e->getMessage()]);
            throw $e;
        }
    }
}
