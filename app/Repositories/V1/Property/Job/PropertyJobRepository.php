<?php

namespace App\Repositories\V1\Property\Job;

use App\Helpers\Helper;
use App\Interfaces\V1\Property\Job\PropertyJobRepositoryInterface;
use App\Models\Property;
use App\Models\PropertyJob;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

class PropertyJobRepository implements PropertyJobRepositoryInterface
{
    /**
     * getJobListByStatus
     * @param string $status
     * @param int $per_page
     * @param int $authId
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getJobListByStatus(string $status, int $per_page, int $authId): LengthAwarePaginator
    {
        try {
            return  PropertyJob::select(['id', 'sn', 'user_id', 'property_id', 'engineer', 'title', 'description', 'date_time', 'status'])
                ->whereUserId($authId)
                ->whereStatus($status)
                ->orderByDesc('id')
                ->paginate($per_page);
        } catch (Exception $e) {
            Log::error('PropertyJobRepository::getJobList', ['error' => $e->getMessage()]);
            throw $e;
        }
    }

    /**
     * getAllPendingJobs
     * @param int $per_page
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAllPendingJobs(int $per_page): LengthAwarePaginator
    {
        try {
            return  PropertyJob::select(['id', 'sn', 'user_id', 'property_id', 'engineer', 'title', 'description', 'date_time', 'status'])
                ->whereStatus('pending')
                ->orderByDesc('id')
                ->paginate($per_page);
        } catch (Exception $e) {
            Log::error('PropertyJobRepository::getAllPendingJobs', ['error' => $e->getMessage()]);
            throw $e;
        }
    }

    /**
     * getEngineerJobs
     * @param string $status
     * @param int $per_page
     * @param int $authId
     */
    public function getEngineerJobs(string $status, int $per_page, int $authId): LengthAwarePaginator
    {
        try {
            return  PropertyJob::select(['id', 'sn', 'user_id', 'property_id', 'engineer', 'title', 'description', 'date_time', 'status'])
                ->whereEngineer($authId)
                ->whereStatus($status)
                ->orderByDesc('id')
                ->paginate($per_page);
        } catch (Exception $e) {
            Log::error('PropertyJobRepository::getEngineerJobs', ['error' => $e->getMessage()]);
            throw $e;
        }
    }

    /**
     * JobCount
     * @param string $column
     * @param int $value
     * @param string $status
     * @return int
     */
    public function JobCount(string $column, int $value, string $status): int
    {
        try {
            return PropertyJob::where($column, $value)->whereStatus($status)->count();
        } catch (Exception $e) {
            Log::error('PropertyJobRepository::jobCount', ['error' => $e->getMessage()]);
            throw $e;
        }
    }


    /**
     * createJob
     * @param array $data
     * @return PropertyJob
     */
    public function createJob(array $data, int $userId): PropertyJob
    {
        try {
            $errorCodeImage = null;
            $image = null;
            $video = null;
            if (isset($data['error_code_image'])) {
                $errorCodeImage = Helper::uploadFile($data['error_code_image'], 'property_job/error_code_image');
            }
            if (isset($data['image'])) {
                $image = Helper::uploadFile($data['image'], 'property_job/image');
            }
            if (isset($data['video'])) {
                $video = Helper::uploadFile($data['video'], 'property_job/video');
            }
            return PropertyJob::create([
                'sn'                   => Helper::generateUniqueId('property_jobs', 'sn'),
                'user_id'              => $userId,
                'property_id'          => $data['property_id'],
                'title'                => $data['title'],
                'description'          => $data['description'],
                'date_time'            => $data['date_time'],
                'error_code'           => $data['error_code'],
                'error_code_image'     => $errorCodeImage,
                'water_pressure_level' => $data['water_pressure_level'],
                'tools_info'           => $data['tools_info'],
                'additional_info'      => $data['additional_info'],
                'image'                => $image,
                'video'                => $video,
            ]);
        } catch (Exception $e) {
            Log::error('PropertyJobRepository::createJob', ['error' => $e->getMessage()]);
            throw $e;
        }
    }

    /**
     * findJobById
     * @param \App\Models\PropertyJob $propertyJob
     * @return PropertyJob
     */
    public function findJobById(PropertyJob $propertyJob): PropertyJob
    {
        try {
            $propertyJob->load([
                'property' => function ($query) {
                    $query->select(['id', 'sn', 'user_id', 'address_id', 'boiler_type_id', 'boiler_model_id', 'property_type_id', 'quantity', 'purchase_year', 'last_service_date', 'location', 'accessability_info', 'radiator', 'price']);
                },
                'user',
                'property.boilerType' => function ($query) {
                    $query->select(['id', 'name']);
                },
                'property.boilerModel' => function ($query) {
                    $query->select(['id', 'name']);
                },
                'property.propertyType' => function ($query) {
                    $query->select(['id', 'name']);
                },
                'property.address' => function ($query) {
                    $query->select(['id', 'street', 'apartment', 'country_id', 'state_id', 'city_id', 'zip_id', 'latitude', 'longitude']);
                },
                'property.address.country' => function ($query) {
                    $query->select(['id', 'name']);
                },
                'property.address.state' => function ($query) {
                    $query->select(['id', 'name']);
                },
                'property.address.city' => function ($query) {
                    $query->select(['id', 'name']);
                },
                'property.address.zip' => function ($query) {
                    $query->select(['id', 'code']);
                }
            ]);

            return $propertyJob;
        } catch (Exception $e) {
            Log::error('PropertyJobRepository::findJobById', ['error' => $e->getMessage()]);
            throw $e;
        }
    }

    /**
     * assignEngineer
     * @param \App\Models\PropertyJob $propertyJob
     * @param int $engineerId
     * @return void
     */
    public function assignEngineer(PropertyJob $propertyJob, int $engineerId): void
    {
        try {
            $propertyJob->engineer = $engineerId;
            $propertyJob->status = 'assigned';
            $propertyJob->engineer_assigned_at = now();
            $propertyJob->save();
        } catch (Exception $e) {
            Log::error('PropertyJobRepository::assignEngineer', ['error' => $e->getMessage()]);
            throw $e;
        }
    }
}
