<?php

namespace App\Services\Web\V1\Location;

use App\Interfaces\V1\Address\City\CityRepositoryInterface;
use App\Models\StateCity;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class CityService
{
protected CityRepositoryInterface $cityRepository;


    /**
     * construct
     * @param cityRepositoryInterface $cityRepository
     */
    public function __construct(CityRepositoryInterface $cityRepository)
    {
        $this->cityRepository = $cityRepository;
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
            $citys= $citys->with('country','state')->get();

            return DataTables::of($citys)
            ->addColumn('country_name', fn($data) => $data->country->name ?? 'N/A')
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
     * @return City
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

    public function countrys()
    {
        try {
            return $this->cityRepository->countrys();
        } catch (Exception $e) {
            Log::error('CityService::country', ['error' => $e->getMessage()]);
            throw $e;
        }
    }

    //get the state of the country
    public function states()
    {
        try {
            return $this->cityRepository->states();
        } catch (Exception $e) {
            Log::error('CityService::state', ['error' => $e->getMessage()]);
            throw $e;
        }
    }

    public function showModelToEdit(StateCity $city):array
    {
        try {
            $states = $this->cityRepository->states();
            $countries = $this->cityRepository->countrys();

            return ['html' => view('backend.layouts.dropdown.city.components.update', compact('city', 'states', 'countries'))->render()];
        } catch (Exception $e) {
            Log::error('cityService::showModelToEdit', ['error' => $e->getMessage()]);
            throw $e;
        }
    }

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
