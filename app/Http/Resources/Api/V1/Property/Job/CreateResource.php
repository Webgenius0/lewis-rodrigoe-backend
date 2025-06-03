<?php

namespace App\Http\Resources\Api\V1\Property\Job;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CreateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = parent::toArray($request);

        return [
            'id'                   => $data['id'],
            'sn'                   => $data['sn'],
            'user_id'              => $data['user_id'],
            'property_id'          => $data['property_id'],
            'title'                => $data['title'],
            'description'          => $data['description'],
            'date_time'            => $data['date_time'],
            'error_code'           => $data['error_code'],
            'error_code_image'     => $data['error_code_image'],
            // 'water_pressure_level' => $data['water_pressure_level'],
            // 'tools_info'           => $data['tools_info'],
            'additional_info'      => $data['additional_info'],
            'image'                => $data['image'],
            'video'                => $data['video'],
        ];
    }
}
