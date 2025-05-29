<?php

namespace App\Services\Api\V1\Property\Job;

use App\Interfaces\V1\Property\Job\PropertyJobRepositoryInterface;
use App\Models\PropertyJob;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PropertyJobService
{
    /**
     * propertyJobRepository
     * @var PropertyJobRepositoryInterface
     */
    protected PropertyJobRepositoryInterface $propertyJobRepository;
    protected $user;

    /**
     * construct
     * @param \App\Interfaces\V1\Property\Job\PropertyJobRepositoryInterface $propertyJobRepository
     */
    public function __construct(PropertyJobRepositoryInterface $propertyJobRepository)
    {
        $this->propertyJobRepository = $propertyJobRepository;
        $this->user = Auth::user();
    }

    /**
     * propertyJobIndex
     * @param string $status
     * @return LengthAwarePaginator
     */
    public function propertyJobIndex(string $status): LengthAwarePaginator
    {
        try {
            $per_page = request()->query('per_page', 25);
            return $this->propertyJobRepository->getJobListByStatus($status, $per_page, $this->user->id);
        } catch (Exception $e) {
            Log::error('PropertyJobService::createJobforProperty', ['error' => $e->getMessage()]);
            throw $e;
        }
    }

    public function engineerJobsIndex(string $status): LengthAwarePaginator
    {
        try {
            $per_page = request()->query('per_page', 25);
            return $this->propertyJobRepository->getJobListByStatus($status, $per_page,$this->user->id);
        } catch (Exception $e) {
            Log::error('PropertyJobService::createJobforProperty', ['error' => $e->getMessage()]);
            throw $e;
        }
    }

    /**
     * createJobforProperty
     * @param array $data
     * @return PropertyJob
     */
    public function createJobforProperty(array $data): PropertyJob
    {
        try {
            return $this->propertyJobRepository->createJob($data, $this->user->id);
        } catch (Exception $e) {
            Log::error('PropertyJobService::createJobforProperty', ['error' => $e->getMessage()]);
            throw $e;
        }
    }

    /**
     * getJobDetails
     * @param \App\Models\PropertyJob $propertyJob
     * @return PropertyJob
     */
    public function getJobDetails(PropertyJob $propertyJob): PropertyJob
    {
        try {
            return $this->propertyJobRepository->findJobById($propertyJob);
        } catch (Exception $e) {
            Log::error('PropertyJobService::getJob', ['error' => $e->getMessage()]);
            throw $e;
        }
    }

    /**
     * assignEngineer
     * @param \App\Models\PropertyJob $propertyJob
     * @return void
     */
    public function assignEngineer(PropertyJob $propertyJob): void
    {
        try {
            $this->propertyJobRepository->assignengineer($propertyJob, $this->user->id);
        } catch (Exception $e) {
            Log::error('PropertyJobService::assignEngineer', ['error' => $e->getMessage()]);
            throw $e;
        }
    }
}
