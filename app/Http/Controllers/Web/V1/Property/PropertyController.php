<?php

namespace App\Http\Controllers\Web\V1\Property;

use App\Http\Controllers\Web\V1\Controller;
use App\Services\Web\V1\Property\PropertyService;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PropertyController extends Controller
{
    /**
     * propertyService
     * @var PropertyService
     */
    private PropertyService $propertyService;

    /**
     * __construct
     * @param \App\Services\Web\V1\Property\PropertyService $propertyService
     */
    public function __construct(PropertyService $propertyService)
    {
        $this->propertyService = $propertyService;
    }

    /**
     * index
     * @return View|\Illuminate\Contracts\View\Factory
     */
    public function index():View
    {
        try {
            $properties = $this->propertyService->allProperties();

            // dd($properties);
            $compact = [
                'properties' => $properties,
            ];
            return view('backend.layouts.property.index', $compact);
        }catch(Exception $e) {
            Log::error('PropertyController::index', [$e->getMessage()]);
            return view('errors.500');
        }
    }
}
