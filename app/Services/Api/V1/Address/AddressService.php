<?php

namespace App\Services\Api\V1\Address;

use App\Interfaces\V1\Address\AddressRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\Log;

class AddressService
{
    private AddressRepositoryInterface $addressRepository;

    /**
     * construct
     * @param \App\Interfaces\V1\Address\AddressRepositoryInterface $addressRepository
     */
    public function __construct(AddressRepositoryInterface $addressRepository)
    {
        $this->addressRepository = $addressRepository;
    }

    /**
     * create
     * @param array $data
     */
    public function create(array $data)
    {
        try {
            return $this->addressRepository->create($data);
        }catch(Exception $e) {
            Log::error('AddressService::create', ['error' => $e->getMessage()]);
            throw $e;
        }
    }
}
