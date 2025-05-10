<?php

namespace App\Services\Api\V1\Property;

use App\Interfaces\V1\Address\AddressRepositoryInterface;
use App\Interfaces\V1\Property\PropertyRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PropertyService
{
    /**
     * propertyRepository
     * @var PropertyRepositoryInterface
     */
    private PropertyRepositoryInterface $propertyRepository;
    private AddressRepositoryInterface $addressRepository;
    private $user;

    /**
     * construct
     * @param \App\Interfaces\V1\Property\PropertyRepositoryInterface $propertyRepository
     * @param \App\Interfaces\V1\Address\AddressRepositoryInterface $addressRepository
     */
    public function __construct(PropertyRepositoryInterface $propertyRepository, AddressRepositoryInterface $addressRepository)
    {
        $this->propertyRepository = $propertyRepository;
        $this->addressRepository = $addressRepository;
        $this->user = Auth::user();
    }

    /**
     * createUserProperty
     * @param array $data
     */
    public function createUserProperty(array $data)
    {
        DB::beginTransaction();
        try {
            $address = $this->addressRepository->createAddress($data);
            $property = $this->propertyRepository->createProperty($data, $this->user->id, $address->id);
            DB::commit();
            return $property;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('PropertyService::createUserProperty', ['error' => $e->getMessage()]);
            throw $e;
        }
    }
}
