<?php

namespace App\Interfaces\Api\V1\Role;

use App\Models\Role;
use Illuminate\Database\Eloquent\Collection;

interface RoleRepositoryInterface
{
    /**
     * getList
     * @return \Illuminate\Database\Eloquent\Collection<int, Role>
     */
    public function getList(): Collection;
}
