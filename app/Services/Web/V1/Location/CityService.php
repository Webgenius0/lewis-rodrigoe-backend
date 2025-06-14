<?php

namespace App\Services\Web\V1\Location;

use App\Interfaces\V1\Address\City\CityRepositoryInterface;
use App\Interfaces\V1\Address\Country\CountryRepositoryInterface;
use App\Interfaces\V1\Address\State\StateRepositoryInterface;
use App\Models\StateCity;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class CityService
{
    private CityRepositoryInterface $cityRepository;
    private StateRepositoryInterface $stateRepository;
    private CountryRepositoryInterface $countryRepository;



    /**
     * construct
     * @param \App\Interfaces\V1\Address\City\CityRepositoryInterface $cityRepository
     * @param \App\Interfaces\V1\Address\State\StateRepositoryInterface $stateRepository
     * @param \App\Interfaces\V1\Address\Country\CountryRepositoryInterface $countryRepository
     */
    public function __construct(CityRepositoryInterface $cityRepository, StateRepositoryInterface $stateRepository, CountryRepositoryInterface $countryRepository)
    {
        $this->cityRepository = $cityRepository;
        $this->stateRepository = $stateRepository;
        $this->countryRepository = $countryRepository;
    }


    /**
     * yajra table for city
     * @param mixed $request
     * @return JsonResponse
     */
    public function index($request): JsonResponse
    {
        try {
            $citys = $this->cityRepository->listOfCity();
            // dd($citys);
            /**
             * applying search operation
             */
            if ($request->has('search') && $request->search) {
                $searchTerm = $request->search;
                $citys->where(function ($query) use ($searchTerm) {
                    $query->where('name', 'like', '%' . $searchTerm . '%')
                        ->orWhereHas('country', function ($q) use ($searchTerm) {
                            $q->where('name', 'like', '%' . $searchTerm . '%');
                        })
                        ->orWhereHas('state', function ($q) use ($searchTerm) {
                            $q->where('name', 'like', '%' . $searchTerm . '%');
                        });
                });
            }
            return DataTables::of($citys)
                ->addColumn('country_name', fn($data) => $data->state->country->name ?? 'N/A')
                ->addColumn('state_name', fn($data) => $data->state->name ?? 'N/A')
                ->addColumn('name', function ($data) {
                    return '<td class="ps-1">
                                 <div class="d-flex align-items-center">
                                     <a>
                                         <h5 class="mb-0">
                                             <a  class="text-inherit">' . $data->name . '</a>
                                         </h5>
                                     </div>
                                 </div>
                             </td>';
                })
                ->addColumn('action', function ($data) {
                    return '<td class="ps-1">
                                 <div class="d-flex align-items-center">
                                     <a>
                                         <button type="button" class="btn btn-secondary-soft mb-2" onclick="editModal(\'' . $data->slug . '\')">Edit</button>
                                         <button type="button" class="btn btn-danger-soft mb-2" onclick="deleteAlert(\'' . $data->slug . '\')" >Delete</button>
                                     </div>
                                 </div>
                             </td>';
                })
                ->rawColumns(['name', 'action'])
                ->make(true);
        } catch (Exception $e) {
            Log::error('CityService::index', ['error' => $e->getMessage()]);
            throw $e;
        }
    }



    /**
     * storing city
     * @param array $credentials
     * @return StateCity
     */
    public function store(array $credentials): StateCity
    {
        try {
            return $this->cityRepository->createCity($credentials);
        } catch (Exception $e) {
            Log::error('cityService::store', ['error' => $e->getMessage()]);
            throw $e;
        }
    }

    /**
     * countrys
     * @return Collection<int, \App\Models\Country>
     */
    public function countrys():Collection
    {
        try {
            return $this->countryRepository->getList();
        } catch (Exception $e) {
            Log::error('CityService::country', ['error' => $e->getMessage()]);
            throw $e;
        }
    }

    /**
     * Summary of states
     * @return Collection<int, \App\Models\CountryState>
     */
    public function states():Collection
    {
        try {
            return $this->stateRepository->listOfState()->get();
        } catch (Exception $e) {
            Log::error('CityService::state', ['error' => $e->getMessage()]);
            throw $e;
        }
    }

    /**
     * showModelToEdit
     * @param \App\Models\StateCity $city
     * @return array{html: string}
     */
    public function showModelToEdit(StateCity $city): array
    {
        try {
            $states = $this->states();
            $countries = $this->countrys();
            return ['html' => view('backend.layouts.location.city.components.update', compact('city', 'states', 'countries'))->render()];
        } catch (Exception $e) {
            Log::error('cityService::showModelToEdit', ['error' => $e->getMessage()]);
            throw $e;
        }
    }

    /**
     * update
     * @param array $credentials
     * @param \App\Models\StateCity $city
     * @return StateCity
     */
    public function update(array $credentials, StateCity $city): StateCity
    {
        try {
            return $this->cityRepository->updateCity($credentials, $city);
        } catch (Exception $e) {
            Log::error('CityService::update', ['error' => $e->getMessage()]);
            throw $e;
        }
    }
}
