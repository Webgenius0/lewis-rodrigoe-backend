<?php

namespace App\Http\Controllers\Api\V1\Address;

use App\Http\Controllers\Api\V1\Controller;
use App\Http\Requests\Api\V1\Address\CreateRequest;
use App\Services\Api\V1\Address\AddressService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AddressController extends Controller
{
    private AddressService $addressService;

    /**
     * construct
     * @param \App\Services\Api\V1\Address\AddressService $addressService
     */
    public function __construct(AddressService $addressService)
    {
        $this->addressService = $addressService;
    }

    /**
     * Store
     * @param \App\Http\Requests\Api\V1\Address\CreateRequest $createRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateRequest $createRequest): JsonResponse
    {
        try {
            $validatedData = $createRequest->validated();
            $data = $this->addressService->create($validatedData);
            return $this->success(201, 'address created', $data);
        }catch(Exception $e) {
            Log::error('AddressController::store', ['error' => $e->getMessage()]);
            return $this->error(500, 'server error', $e->getMessage());
        }
    }
}
