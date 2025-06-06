<?php

namespace App\Services\Web\V1\Location;

use App\Interfaces\V1\Address\Country\CountryRepositoryInterface;
use App\Interfaces\V1\Address\State\StateRepositoryInterface;
use App\Models\CountryState;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;

class StateService
{
    /**
     * stateRepository
     * @var StateRepositoryInterface
     */
    protected StateRepositoryInterface $stateRepository;
    /**
     * countryRepository
     * @var CountryRepositoryInterface
     */
    protected CountryRepositoryInterface $countryRepository;

    /**
     * construct
     * @param \App\Interfaces\V1\Address\Country\CountryRepositoryInterface $countryRepository
     * @param \App\Interfaces\V1\Address\State\StateRepositoryInterface $stateRepository
     */
    public function __construct(CountryRepositoryInterface $countryRepository, StateRepositoryInterface $stateRepository)
    {
        $this->countryRepository = $countryRepository;
        $this->stateRepository = $stateRepository;
    }

    /**
     * index
     * @param mixed $request
     * @throws \Exception
     * @return JsonResponse|mixed
     */
    public function index($request): JsonResponse
    {
        try {
            // Ensure `listOfState()` returns a query builder, not a collection
            $query = $this->stateRepository->listOfState();

            if (!$query instanceof \Illuminate\Database\Eloquent\Builder) {
                throw new Exception("listOfState() must return a query builder, not a collection.");
            }

            // Load 'country' relation before getting data
            $query = $query->with('country');

            // Apply search filter if present
            if ($request->has('search') && $request->search) {
                $searchTerm = $request->search;
                $query->where('name', 'like', '%' . $searchTerm . '%')
                    ->orWhereHas('country', function ($q) use ($searchTerm) {
                        $q->where('name', 'like', '%' . $searchTerm . '%');
                    });
            }

            $states = $query->get(); // Get the final filtered data

            return DataTables::of($states)
                ->addColumn('country_name', fn($data) => $data->country->name ?? 'N/A')
                ->addColumn('name', function ($data) {
                    return '<td class="ps-1">
                                 <div class="d-flex align-items-center">
                                     <h5 class="mb-0">
                                         <a class="text-inherit">' . e($data->name) . '</a>
                                     </h5>
                                 </div>
                             </td>';
                })
                ->addColumn('action', function ($data) {
                    return '<td class="ps-1">
                                 <div class="d-flex align-items-center">
                                     <button type="button" class="btn btn-secondary-soft mb-2" onclick="editModal(\'' . e($data->slug) . '\')">Edit</button>
                                     <button type="button" class="btn btn-danger-soft mb-2" onclick="deleteAlert(\'' . e($data->slug) . '\')">Delete</button>
                                 </div>
                             </td>';
                })
                ->rawColumns(['name', 'action'])
                ->make(true);
        } catch (Exception $e) {
            Log::error('StateService::index - Error fetching states', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Something went wrong!'], 500);
        }
    }

    /**
     * storeState
     * @param array $credentials
     * @return CountryState
     */
    public function storeState(array $credentials): CountryState
    {
        try {
            return $this->stateRepository->storeState($credentials);
        } catch (Exception $e) {
            Log::error('StateService::storeState', ['error' => $e->getMessage()]);
            throw $e;
        }
    }

    /**
     * showModelToEdit
     * @param \App\Models\CountryState $state
     * @return array{html: string}
     */
    public function showModelToEdit(CountryState $state): array
    {
        try {
            $countries = $this->countryRepository->getList();
            Log::info($countries);
            return ['html' => view('backend.layouts.location.state.components.update', compact('state', 'countries'))->render()];
        } catch (Exception $e) {
            Log::error('StateService::showModelToEdit', ['error' => $e->getMessage()]);
            throw $e;
        }
    }

    /**
     * updateState
     * @param array $credentials
     * @param \App\Models\CountryState $state
     * @return CountryState
     */
    public function updateState(array $credentials, CountryState $state): CountryState
    {
        try {
            return $this->stateRepository->updateState($credentials, $state);
        } catch (Exception $e) {
            Log::error('StateService::updateState', ['error' => $e->getMessage()]);
            throw $e;
        }
    }
}
