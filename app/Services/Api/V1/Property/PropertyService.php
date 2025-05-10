<?php

namespace App\Services\Api\V1\Property;

use App\Interfaces\V1\Address\AddressRepositoryInterface;
use App\Interfaces\V1\Property\PropertyRepositoryInterface;
use App\Models\Property;
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
    protected $user;

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
     * @return \App\Models\Property
     */
    public function createUserProperty(array $data): Property
    {
        DB::beginTransaction();
        try {
            $address = $this->addressRepository->createAddress($data);
            $property = $this->propertyRepository->createProperty($data, $this->user->id, $address->id);
            DB::commit();
            return $property->load('address');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('PropertyService::createUserProperty', ['error' => $e->getMessage()]);
            throw $e;
        }
    }
}
