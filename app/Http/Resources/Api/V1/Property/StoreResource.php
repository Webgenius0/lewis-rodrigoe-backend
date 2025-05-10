<?php

namespace App\Http\Resources\Api\V1\Property;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StoreResource extends JsonResource
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
            'id'                 => $data['id'],
            'label'              => $data['address']['label'],
            'street'             => $data['address']['street'],
            'apartment'          => $data['address']['apartment'],
            'country_id'         => $data['address']['country_id'],
            'state_id'           => $data['address']['state_id'],
            'city_id'            => $data['address']['city_id'],
            'zip_id'             => $data['address']['zip_id'],
            'latitude'           => $data['address']['latitude'],
            'longitude'          => $data['address']['longitude'],
            'boiler_type_id'     => $data['boiler_type_id'],
            'boiler_model_id'    => $data['boiler_model_id'],
            'property_type_id'   => $data['property_type_id'],
            'quantity'           => $data['quantity'],
            'purchase_year'      => $data['purchase_year'],
            'last_service_date'  => $data['last_service_date'],
            'location'           => $data['location'],
            'accessability_info' => $data['accessability_info'],
        ];
    }
}
