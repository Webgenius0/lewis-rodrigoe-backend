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
     * @param int $authId
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getJobListByStatus(string $status, int $per_page, int $authId): LengthAwarePaginator;


    /**
     * getAllPendingJobs
     * @param int $per_page
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAllPendingJobs(int $per_page): LengthAwarePaginator;

    /**
     * getEngineerJobs
     * @param string $status
     * @param int $per_page
     * @param int $authId
     */
    public function getEngineerJobs(string $status, int $per_page, int $authId): LengthAwarePaginator;

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
     * assignEngineer
     * @param \App\Models\PropertyJob $propertyJob
     * @param int $engineerId
     * @return void
     */
    public function assignEngineer(PropertyJob $propertyJob, int $engineerId): void;
}
