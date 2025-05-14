<?php

namespace App\Http\Resources\Api\V1\Property;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DropdownResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $responds =  parent::toArray($request);
        $data = [];
        foreach ($responds as $response) {
            $data[] = [
                'id' => $response['id'],
                'address' => $response['address']['label'] . ', ' . $response['address']['street'] . ', ' . $response['address']['apartment'],
            ];
        }
        return $data;
    }
}
