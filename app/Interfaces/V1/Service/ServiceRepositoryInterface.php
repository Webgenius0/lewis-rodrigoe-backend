<?php

namespace App\Interfaces\V1\Service;

use App\Models\Service;
use Illuminate\Database\Eloquent\Collection;

interface ServiceRepositoryInterface
{
    /**
     * getList
     * @return \Illuminate\Database\Eloquent\Collection<int, Service>
     */
    public function getList(): Collection;
}
