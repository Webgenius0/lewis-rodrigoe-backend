<?php

namespace App\Services\Api\V1\Property\Job;

use App\Interfaces\V1\Property\Job\PropertyJobRepositoryInterface;
use App\Models\PropertyJob;
use Exception;
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
     * createJobforProperty
     * @param array $data
     * @return PropertyJob
     */
    public function createJobforProperty(array $data): PropertyJob
    {
        try {
            return $this->propertyJobRepository->createJob($data, $this->user->id);
        }catch (Exception $e) {
            Log::error('PropertyJobService::createJobforProperty', ['error' => $e->getMessage()]);
            throw $e;
        }
    }
}
