<?php

namespace App\Repositories\V1\Property\Job;

use App\Helpers\Helper;
use App\Interfaces\V1\Property\Job\PropertyJobRepositoryInterface;
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
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getJobListByStatus(string $status, int $per_page): LengthAwarePaginator
    {
        try {
            return  PropertyJob::whereStatus($status)->paginate($per_page);
        } catch (Exception $e) {
            Log::error('PropertyJobRepository::getJobList', ['error' => $e->getMessage()]);
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
            return PropertyJob::create([
                'sn'                   => Helper::generateUniqueId('property_jobs', 'sn'),
                'user_id'              => $userId,
                'property_id'          => $data['property_id'],
                'title'                => $data['title'],
                'description'          => $data['description'],
                'date_time'            => $data['date_time'],
                'error_code'           => $data['error_code'],
                'error_code_image'     => $data['error_code_image'],
                'water_pressure_level' => $data['water_pressure_level'],
                'tools_info'           => $data['tools_info'],
                'additional_info'      => $data['additional_info'],
                'image'                => $data['image'],
                'video'                => $data['video'],
            ]);
        } catch (Exception $e) {
            Log::error('PropertyJobRepository::createJob', ['error' => $e->getMessage()]);
            throw $e;
        }
    }
}
