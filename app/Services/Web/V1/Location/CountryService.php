<?php

namespace App\Services\Web\V1\Location;

use App\Interfaces\V1\Address\Country\CountryRepositoryInterface;
use App\Models\Country;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class CountryService
{
    /**
     * countryRepository
     * @var CountryRepositoryInterface
     */
    private CountryRepositoryInterface $countryRepository;
    /**
     * construct
     * @param \App\Interfaces\V1\Address\Country\CountryRepositoryInterface $countryRepository
     */
    public function __construct(CountryRepositoryInterface $countryRepository)
    {
        $this->countryRepository = $countryRepository;
    }

    /**
     * countries
     * @return \Illuminate\Database\Eloquent\Collection<int, Country>
     */
    public function countries()
    {
        try {
            return $this->countryRepository->getList();
        } catch (Exception $e) {
            Log::error('CountryService::countries', ['error' => $e->getMessage()]);
            throw $e;
        }
    }

    /**
     * index
     * @param mixed $request
     * @return JsonResponse
     */
    public function index($request): JsonResponse
    {
        try {
            $countrys = $this->countries();
            /**
             * applying search operation
             */
            if ($request->has('search') && $request->search) {
                $searchTerm = $request->search;
                $countrys->where(function ($countrys) use ($searchTerm) {
                    $countrys->where('name', 'like', '%' . $searchTerm . '%');
                });
            }
            return DataTables::of($countrys)
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
            Log::error('CountryService::index', ['error' => $e->getMessage()]);
            throw $e;
        }
    }

    /**
     * store
     * @param array $credentials
     * @return Country
     */
    public function store(array $credentials): Country
    {
        try {
            return $this->countryRepository->createCountry($credentials);
        } catch (Exception $e) {
            Log::error('CountryService::store', ['error' => $e->getMessage()]);
            throw $e;
        }
    }

    /**
     * showModelToEdit
     * @param \App\Models\Country $country
     * @return array{html: string}
     */
    public function showModelToEdit(Country $country): array
    {
        try {
            return ['html' => view('backend.layouts.location.country.components.update', compact('country'))->render()];
        } catch (Exception $e) {
            Log::error('CountryService::showModelToEdit', ['error' => $e->getMessage()]);
            throw $e;
        }
    }

    /**
     * update
     * @param array $credentials
     * @param \App\Models\Country $country
     * @return void
     */
    public function update(array $credentials, Country $country): void
    {
        try {
            $this->countryRepository->updateCountry($credentials, $country);
        } catch (Exception $e) {
            Log::error('CountryService::update', ['error' => $e->getMessage()]);
            throw $e;
        }
    }
}
