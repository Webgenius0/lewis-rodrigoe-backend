<?php

namespace App\Interfaces\V1\Property\Job;

use App\Models\PropertyJob;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface PropertyJobRepositoryInterface
{
    /**
     * getJobListByStatus
     * @param string $status
     * @param int $per_page
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getJobListByStatus(string $status, int $per_page): LengthAwarePaginator;

    /**
     * createJob
     * @param array $data
     * @return PropertyJob
     */
    public function createJob(array $data, int $userId): PropertyJob;

    /**
     * JobCount
     * @param string $column
     * @param int $value
     * @param string $status
     * @return int
     */
    public function JobCount(string $column, int $value, string $status): int;

    /**
     * findJobById
     * @param \App\Models\PropertyJob $propertyJob
     * @return PropertyJob
     */
    public function findJobById(PropertyJob $propertyJob): PropertyJob;

    /**
     * assignengineer
     * @param \App\Models\PropertyJob $propertyJob
     * @param int $engineerId
     * @return void
     */
    public function assignengineer(PropertyJob $propertyJob, int $engineerId): void;
}
