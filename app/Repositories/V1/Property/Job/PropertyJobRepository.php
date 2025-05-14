<?php

namespace App\Repositories\V1\Property\Job;

use App\Helpers\Helper;
use App\Interfaces\V1\Property\Job\PropertyJobRepositoryInterface;
use App\Models\PropertyJob;
use Exception;
use Illuminate\Support\Facades\Log;

class PropertyJobRepository implements PropertyJobRepositoryInterface
{
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
                'engineer'             => $data['engineer'],
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
