<?php

namespace App\Http\Controllers\Web\V1\Location;

use App\Http\Controllers\Web\V1\Controller;
use App\Services\Web\V1\Location\CountryService;
use Exception;
use Illuminate\Contracts\View\View;
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
     * @param \App\Services\Web\V1\Location\CountryService $countryService
     */
    public function __construct(CountryService $countryService) {
        $this->countryService = $countryService;
    }

    /**
     * Summary of index
     * @param \Illuminate\Http\Request $request
     * @return View
     */
    public function index(Request $request):View
    {
        try {
            if ($request->ajax())
            {

            }
            return view('backend.layouts.location.country.index');
        }catch(Exception $e) {
            Log::error("CountryController::index", [$e->getMessage()]);
            return view('errors.404');
        }
    }


    public function store()
    {

    }

    public function edit(){}
    public function update(){}
    public function destroy(){}

}
