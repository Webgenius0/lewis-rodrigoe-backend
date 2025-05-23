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
    private OwnerPropertyCalculation $ownerPropertyCalculation;
    protected $user;

    /**
     * __construct
     * @param \App\Interfaces\V1\Property\PropertyRepositoryInterface $propertyRepository
     * @param \App\Interfaces\V1\Address\AddressRepositoryInterface $addressRepository
     * @param \App\Services\Api\V1\Property\OwnerPropertyCalculation $ownerPropertyCalculation
     */
    public function __construct(
        PropertyRepositoryInterface $propertyRepository,
        AddressRepositoryInterface $addressRepository,
        OwnerPropertyCalculation $ownerPropertyCalculation
    ) {
        $this->propertyRepository = $propertyRepository;
        $this->addressRepository = $addressRepository;
        $this->ownerPropertyCalculation = $ownerPropertyCalculation;
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

    /**
     * userPropertyDropdown
     */
    public function userPropertyDropdown(): mixed
    {
        try {
            return $this->propertyRepository->getUserPropertyAddressLabel($this->user->id);
        } catch (Exception $e) {
            Log::error('PropertyService::propertyDropdownOfUser', ['error' => $e->getMessage()]);
            throw $e;
        }
    }

    /**
     * priceGeneration
     * @param array $data
     * @return array
     */
    public function priceGeneration(array $data): array
    {
        try {

            $price = $this->ownerPropertyCalculation->propertyCostCalculation($data);

            return ['price' => $price];
        } catch (Exception $e) {
            Log::error('PropertyService::priceGeneration', ['error' => $e->getMessage()]);
            throw $e;
        }
    }
}
