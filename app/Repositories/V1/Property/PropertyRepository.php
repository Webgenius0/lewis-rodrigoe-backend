<?php

namespace App\Repositories\V1\Property;

use App\Helpers\Helper;
use App\Interfaces\V1\Property\PropertyRepositoryInterface;
use App\Models\Address;
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
     * @return Property
     */
    public function createProperty(array $data, int $userId, int $addressId): Property
    {
        try {
            return Property::create([
                'sn'                 => Helper::generateUniqueId('properties', 'sn'),
                'user_id'            => $userId,
                'address_id'         => $addressId,
                'boiler_type_id'     => $data['boiler_type_id'],
                'boiler_model_id'    => $data['boiler_model_id'],
                'property_type_id'   => $data['property_type_id'],
                'service_id'         => $data['service_id'],
                'quantity'           => $data['quantity'],
                'purchase_year'      => $data['purchase_year'],
                'last_service_date'  => $data['last_service_date'],
                'location'           => $data['location'],
                'accessability_info' => $data['accessability_info'],
            ]);
        } catch (Exception $e) {
            Log::error('PropertyRepository::createProperty', ['error' => $e->getMessage()]);
            throw $e;
        }
    }

    /**
     * getUserPropertyAddressLabel
     * @param int $userId
     */
    public function getUserPropertyAddressLabel(int $userId)
    {
        try {
            return Property::with(['address'])->whereUserId($userId)->get();
        }catch (Exception $e) {
            Log::error('PropertyRepository::getUserPropertyAddressLabel', ['error' => $e->getMessage()]);
            throw $e;
        }
    }
}
