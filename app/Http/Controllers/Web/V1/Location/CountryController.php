<?php

namespace App\Http\Controllers\Web\V1\Location;

use App\Http\Controllers\Web\V1\Controller;
use App\Http\Requests\Web\V1\Location\Country\CreateRequest;
use App\Models\Country;
use App\Services\Web\V1\Location\CountryService;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class CountryController extends Controller
{
    protected CountryService $countryService;


    public function __construct(CountryService $countryService)
    {
        $this->countryService = $countryService;
    }

    public function index(Request $request): JsonResponse|RedirectResponse|View
    {
        try {
            if ($request->ajax()) {
                return $this->countryService->index($request);
            }
            return view('backend.layouts.location.country.index');
        } catch (Exception $e) {
            Log::error('CountryController::index', ['error' => $e->getMessage()]);
            return view('errors.500');
        }
    }

    public function store(CreateRequest $createRequest): JsonResponse
    {
        try {
            $validatedData = $createRequest->validated();
            $response = $this->countryService->store($validatedData);
            return $this->success(201, 'Created Successfully.', $response);
        } catch (Exception $e) {
            Log::error('CountryController::store', ['error' => $e->getMessage()]);
            return $this->error(500, 'Server Error.');
        }
    }


    public function edit(Country $country): JsonResponse
    {
        try {
            $response = $this->countryService->showModelToEdit($country);
            return $this->success(200, 'Successfull', $response);
        } catch (Exception $e) {
            Log::error('CountryController::edit', ['error' => $e->getMessage()]);
            return $this->error(500, 'Server Error.');
        }
    }

    public function update(CreateRequest $updateRequest, Country $country): JsonResponse
    {
        try {
            $validatedData = $updateRequest->validated();
            $this->countryService->update($validatedData, $country);
            return $this->success(202, 'Updated Successfully');
        } catch (Exception $e) {
            Log::error('CountryController::update', ['error' => $e->getMessage()]);
            return $this->error(500, 'Server Error.');
        }
    }

    public function destroy(Country $country): JsonResponse
    {
        try {
            $country->delete();
            return $this->success(202, 'Updated Successfully');
        } catch (Exception $e) {
            Log::error('CountryController::destroy', ['error' => $e->getMessage()]);
            return $this->error(500, 'Server Error.');
        }
    }
}
