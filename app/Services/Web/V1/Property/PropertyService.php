<?php

namespace App\Services\Web\V1\Property;

use App\Interfaces\V1\Address\AddressRepositoryInterface;
use App\Interfaces\V1\Property\PropertyRepositoryInterface;
use App\Services\Api\V1\Property\OwnerPropertyCalculation;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
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
     * allProperties
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function allProperties(): LengthAwarePaginator
    {
        try {
            $per_page = request()->input('per_page', 25);
            return $this->propertyRepository->allProperties($per_page);
        }catch (Exception $e) {
            Log::error('PropertyService::allProperties', [$e->getMessage()]);
            throw $e;
        }
    }

}
