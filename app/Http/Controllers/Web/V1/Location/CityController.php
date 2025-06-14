<?php

namespace App\Http\Controllers\Web\V1\Location;

use App\Http\Controllers\Web\V1\Controller;
use App\Http\Requests\Web\V1\Location\City\CreateRequest;
use App\Models\StateCity;
use App\Services\Web\V1\Location\CityService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class CityController extends Controller
{
    protected CityService $cityService;

    /**
     * construct
     * @param cityService $cityService
     */

    public function __construct(CityService $cityService) {
        $this->cityService = $cityService;
    }
    /**
     * Summary of index
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function index(Request $request): JsonResponse | RedirectResponse | View {
        try {
            if ($request->ajax()) {
                return $this->cityService->index($request);
            }
            $countries = $this->cityService->countrys();
            $states = $this->cityService->states();
            // dd($countries);
            return view('backend.layouts.location.city.index', compact('countries', 'states'));
        } catch (Exception $e) {
            Log::error('CityController::index', ['error' => $e->getMessage()]);
            return redirect()->back()->with('t-error', 'Something went wring..!');
        }
    }

    /**
     * Summary of store
     * @param CreateRequest $cityRequest
     * @return JsonResponse
     */
    public function store(CreateRequest $cityRequest): JsonResponse {
        // dd($cityRequest);
        try {
            $validatedData = $cityRequest->validated();
            // dd($validatedData);
            $response = $this->cityService->store($validatedData);
            return $this->success(201, 'Created Successfully.', $response);
        } catch (Exception $e) {
            Log::error('CityController::store', ['error' => $e->getMessage()]);
            return $this->error(500, 'Server Error.');
        }
    }

    /**
     * Summary of edit
     * @param StateCity $city
     * @return JsonResponse
     */
    public function edit(StateCity $city): JsonResponse {
       try {
            $response = $this->cityService->showModelToEdit($city);
            return $this->success(200, 'Successfull', $response);
        } catch (Exception $e) {
            Log::error('CityController::edit', ['error' => $e->getMessage()]);
            return $this->error(500, 'Server Error.');
        }
    }

    /**
     * Summary of update
     * @param CreateRequest $updateRequest
     * @param StateCity $city
     * @return JsonResponse
     */
    public function update(CreateRequest $updateRequest, StateCity $city): JsonResponse {
        try {
            $validatedData = $updateRequest->validated();

            $response = $this->cityService->update($validatedData, $city);

            return $this->success(200, 'Updated Successfully.', $response);

        } catch (Exception $e) {
            Log::error('CityController::update', ['error' => $e->getMessage()]);
            return $this->error(500, 'Server Error.');
        }
    }

    /**
     * Summary of delete
     * @param int $slug
     * @return JsonResponse
     */

    public function destroy(StateCity $city): JsonResponse {
        try {
            $city->delete();
            return $this->success(202, 'Delete Successfully');
        } catch (Exception $e) {
            Log::error('CityController::destroy', ['error' => $e->getMessage()]);
            return $this->error(500, 'Server Error.');
        }
    }
}
