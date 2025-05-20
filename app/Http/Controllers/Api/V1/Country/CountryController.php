<?php

namespace App\Http\Controllers\Api\V1\Country;

use App\Http\Controllers\Api\V1\Controller;
use App\Services\Api\V1\Country\CountryService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CountryController extends Controller
{
    /**
     * countryService
     * @var CountryService
     */
    private CountryService $countryService;

    /**
     * __construct
     * @param \App\Services\Api\V1\Country\CountryService $countryService
     */
    public function __construct(CountryService $countryService)
    {
        $this->countryService = $countryService;
    }

    /**
     * index
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $response = $this->countryService->getIndex();
            return $this->success(200, 'country list', $response);
        } catch (Exception $e) {
            Log::error("CountryController::index", ['message' => $e->getMessage()]);
            return $this->error(500, 'server error');
        }
    }
}
