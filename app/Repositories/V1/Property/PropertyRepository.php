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
     * getUserPropertyAddressLabel
     * @param int $userId
     */
    public function getUserPropertyAddressLabel(int $userId)
    {
        try {
            return Property::select(['id', 'address_id'])->with(['address:id,label,street,apartment'])->whereUserId($userId)->get();
        } catch (Exception $e) {
            Log::error('PropertyRepository::getUserPropertyAddressLabel', ['error' => $e->getMessage()]);
            throw $e;
        }
    }


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
     * updatePropertyBoiler
     * @param \App\Models\Property $property
     * @param array $data
     * @return void
     */
    public function updatePropertyBoiler(Property $property, array $data): void
    {
        try {
            $property->boiler_type_id = $data['boiler_type_id'];
            $property->boiler_model_id = $data['boiler_model_id'];
            $property->quantity = $data['quantity'];
            $property->purchase_year = $data['purchase_year'];
            $property->last_service_date = $data['last_service_date'];
            $property->location = $data['location'];
            $property->save();
        } catch (Exception $e) {
            Log::error('PropertyRepository::updatePropertyBoiler', ['error' => $e->getMessage()]);
            throw $e;
        }
    }
}
