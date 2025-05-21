<?php

namespace App\Repositories\V1\Address;

use App\Helpers\Helper;
use App\Interfaces\V1\Address\AddressRepositoryInterface;
use App\Models\Address;
use Exception;
use Illuminate\Support\Facades\Log;

class AddressRepository implements AddressRepositoryInterface
{
    /**
     * create Address
     * @param array $data
     * @return Address
     */
    public function createAddress(array $data): Address
    {
        try {
            return Address::create([
                'uin'        => Helper::generateUniqueId('addresses', 'uin'),
                'label'      => $data['label'],
                'street'     => $data['street'],
                'apartment'  => $data['apartment'],
                'country_id' => $data['country_id'],
                'state_id'   => $data['state_id'],
                'city_id'    => $data['city_id'],
                'zip_id '    => $data['zip_id'],
                'latitude'   => $data['latitude'],
                'longitude'  => $data['longitude'],
            ]);
        } catch (Exception $e) {
            Log::error('AddressRepository::getList', ['error' => $e->getMessage()]);
            throw $e;
        }
    }

    /**
     * updateAddress
     * @param \App\Models\Address $address
     * @return void
     */
    public function updateAddress(array $data, Address $address)
    {
        try {
            $address->update([
                'label'      => $data['label'],
                'street'     => $data['street'],
                'apartment'  => $data['apartment'],
                'country_id' => $data['country_id'],
                'state_id'   => $data['state_id'],
                'city_id'    => $data['city_id'],
                'zip_id '    => $data['zip_id'],
                'latitude'   => $data['latitude'],
                'longitude'  => $data['longitude'],
            ]);
        } catch (Exception $e) {
            Log::error('AddressRepository::updateAddress', ['error' => $e->getMessage()]);
            throw $e;
        }
    }
}
