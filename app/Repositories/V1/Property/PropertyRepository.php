<?php

namespace App\Repositories\V1\Property;

use App\Helpers\Helper;
use App\Interfaces\V1\Property\PropertyRepositoryInterface;
use App\Models\Property;
use Exception;
use Illuminate\Support\Facades\Log;

class PropertyRepository implements PropertyRepositoryInterface
{
    /**
     * createProperty
     * @param array $data
     * @param int $userId
     * @param int $addressId
     */
    public function createProperty(array $data, int $userId, int $addressId)
    {
        try {
            return Property::created([
                'sn' => Helper::generateUniqueId('properties', 'sn'),
                'user_id' => $userId,
                'address_id' => $addressId,
                'boiler_type_id' => $data['boiler_type_id'],
                'boiler_model_id' => $data['boiler_model_id'],
                'property_type_id' => $data['property_type_id'],
                'quantity' => $data['quantity'],
                'purchase_year' => $data['purchase_year'],
                'last_service_date' => $data['last_service_date'],
                'location' => $data['location'],
                'accessability_info' => $data['accessability_info'],
            ]);
        } catch (Exception $e) {
            Log::error('PropertyRepository::createProperty', ['error' => $e->getMessage()]);
            throw $e;
        }
    }
}
