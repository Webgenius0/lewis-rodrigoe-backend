<?php

namespace App\Services\Api\V1\Property;

use App\Interfaces\V1\Property\Type\PropertyTypeRepositoryInterface;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;

class GeneralCalculation
{
    private PropertyTypeRepositoryInterface $propertyTypeRepository;

    /**
     * __construct
     * @param \App\Interfaces\V1\Property\Type\PropertyTypeRepositoryInterface $propertyTypeRepository
     */
    public function __construct(PropertyTypeRepositoryInterface $propertyTypeRepository)
    {
        $this->propertyTypeRepository = $propertyTypeRepository;
    }

    public function propertyCostCalculation(array $data)
    {
        try {
            $propertyTypeCost = $this->propertyRate($data['property_type_id']);

        } catch (Exception $e) {
            Log::error('PropertyService::generalPropertyCostCalculation', ['error' => $e->getMessage()]);
            throw $e;
        }
    }

    /**
     * propertyRate
     * @param int $id
     * @return int
     */
    public function propertyRate(int $id): int
    {
        try {
            $propertyType = $this->propertyTypeRepository->findPropertyType($id);
            $type = $propertyType->name;
            $rate = 0;
            if ($type == "Flat") $rate = 22;
            else if ($type == "House") $rate = 24;
            else if ($type == "Commercial Unit") $rate = 30;
            else $rate = 24;
            return $rate;
        } catch (Exception $e) {
            Log::error('PropertyService::generalpropertyRate', ['error' => $e->getMessage()]);
            throw $e;
        }
    }

    /**
     * boilerType
     * @param string $type
     * @return int
     */
    public function boilerType(string $type): int
    {
        try {
            $rate = 0;
            if ($type == "ASHP") $rate = 3;
            return $rate;
        } catch (Exception $e) {
            Log::error('PropertyService::boilerType', ['error' => $e->getMessage()]);
            throw $e;
        }
    }

    /**
     * lastService
     * @param string|null $historyDate
     * @return int
     */
    public function lastService(string|null $historyDate): int
    {
        try {
            $adjustment = 0;
            if (is_null($historyDate)) {
                return 5;
            }
            $history = Carbon::parse($historyDate);
            $now = Carbon::now();

            $yearsDiff = $history->diffInYears($now);

            if ($yearsDiff < 1) {
                $adjustment = 0;
            } elseif ($yearsDiff >= 1 && $yearsDiff < 2) {
                $adjustment = 1;
            } elseif ($yearsDiff >= 2 && $yearsDiff < 4) {
                $adjustment = 2;
            } else {
                $adjustment = 5;
            }

            return $adjustment;
        } catch (Exception $e) {
            Log::error('PropertyService::lastService', ['error' => $e->getMessage()]);
            throw $e;
        }
    }

    /**
     * postCode
     * @param string $postCode
     * @return int
     */
    public function postCode(string $postCode)
    {
        try {
            $adjustment = 0;
            $londonPrefixes = ["N", "E", "W", "SE", "SW", "NW", "EC", "WC"];

            if (preg_match('/^[A-Z]+/', strtoupper(trim($postCode)), $matches)) {
                $prefix = $matches[0];

                if (in_array($prefix, $londonPrefixes)) {
                    $adjustment = 3;
                }
            }

            return $adjustment;
        } catch (Exception $e) {
            Log::error('PropertyService::postCode', ['error' => $e->getMessage()]);
            throw $e;
        }
    }
}
