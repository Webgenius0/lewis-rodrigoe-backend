<?php

namespace App\Interfaces\V1\Property\Job;

use App\Models\PropertyJob;

interface PropertyJobRepositoryInterface
{
    /**
     * createJob
     * @param array $data
     * @return PropertyJob
     */
    public function createJob(array $data, int $userId): PropertyJob;
}
