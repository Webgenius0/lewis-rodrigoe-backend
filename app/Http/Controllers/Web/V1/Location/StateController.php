<?php

namespace App\Http\Controllers\Web\V1\Location;

use App\Http\Controllers\Web\V1\Controller;
use App\Http\Requests\Web\V1\Location\State\StateRequest;
use App\Models\CountryState;
use App\Services\Web\V1\Location\CountryService;
use App\Services\Web\V1\Location\StateService;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StateController extends Controller
{
    protected CountryService $countryService;
    protected StateService $stateService;

    public function __construct(CountryService $countryService, StateService $stateService)
    {
        $this->countryService = $countryService;
        $this->stateService = $stateService;
    }
    public function index(Request $request): JsonResponse|RedirectResponse|View
    {
        try {
            if ($request->ajax()) {
                return $this->stateService->index($request);
            }
            $countries = $this->countryService->countries();

            return view('backend.layouts.location.state.index', compact('countries'));
        } catch (Exception $e) {
            Log::error('App\Http\Controllers\Web\Backend\V1\Dropdown\StateController::index', ['error' => $e->getMessage()]);
            return view('errors.500');
        }
    }

    public function store(StateRequest $stateRequest): JsonResponse
    {
        try {
            $validatedData = $stateRequest->validated();
            // dd($validatedData);
            $response = $this->stateService->storeState($validatedData);
            return $this->success(201, 'Created Successfully.', $response);
        } catch (Exception $e) {
            Log::error('App\Http\Controllers\Web\Backend\V1\Dropdown\CityController::store', ['error' => $e->getMessage()]);
            return $this->error(500, 'Server Error.');
        }
    }

    public function edit(CountryState $state): JsonResponse
    {
        try {
            $response = $this->stateService->showModelToEdit($state);
            return $this->success(200, 'Successful', $response);
        } catch (Exception $e) {
            Log::error('App\Http\Controllers\Web\Backend\V1\Dropdown\StateController::edit', ['error' => $e->getMessage()]);
            return $this->error(500, 'Server Error.');
        }
    }

    public function update(StateRequest $updateRequest, CountryState $state): JsonResponse
    {
        try {
            $validatedData = $updateRequest->validated();
            $this->stateService->updateState($validatedData, $state);
            return $this->success(200, 'Updated Successfully');
        } catch (Exception $e) {
            Log::error('App\Http\Controllers\Web\Backend\V1\Dropdown\StateController::update', ['error' => $e->getMessage()]);
            return $this->error(500, 'Server Error.');
        }
    }

    public function destroy(CountryState $state): JsonResponse
    {
        try {
            $state->delete();
            return $this->success(202, 'Delete Successfully');
        } catch (Exception $e) {
            Log::error('App\Http\Controllers\Web\Backend\V1\Dropdown\CountryController::destroy', ['error' => $e->getMessage()]);
            return $this->error(500, 'Server Error.');
        }
    }
}
