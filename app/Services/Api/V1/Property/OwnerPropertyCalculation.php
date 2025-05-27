<?php

namespace App\Services\Api\V1\Property;

use App\Interfaces\V1\Address\Zip\ZipRepositoryInterface;
use App\Interfaces\V1\Boiler\Model\BoilerModelRepositoryInterface;
use App\Interfaces\V1\Boiler\Type\BoilerTypeRepositoryInterface;
use App\Interfaces\V1\Property\Type\PropertyTypeRepositoryInterface;
use App\Models\BoilerModel;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Expr\Cast\Double;

class OwnerPropertyCalculation
{
    private PropertyTypeRepositoryInterface $propertyTypeRepository;
    private BoilerTypeRepositoryInterface $boilerTypeRepository;
    private BoilerModelRepositoryInterface $boilerModelRepository;
    private ZipRepositoryInterface $zipRepository;

    /**
     * OwnerPropertyCalculation constructor.
     * @param PropertyTypeRepositoryInterface $propertyTypeRepository
     * @param BoilerTypeRepositoryInterface $boilerTypeRepository
     * @param BoilerModelRepositoryInterface $boilerModelRepository
     * @param ZipRepositoryInterface $zipRepository
     */
    public function __construct(
        PropertyTypeRepositoryInterface $propertyTypeRepository,
        BoilerTypeRepositoryInterface $boilerTypeRepository,
        BoilerModelRepositoryInterface $boilerModelRepository,
        ZipRepositoryInterface $zipRepository
    ) {
        $this->propertyTypeRepository = $propertyTypeRepository;
        $this->boilerTypeRepository = $boilerTypeRepository;
        $this->boilerModelRepository = $boilerModelRepository;
        $this->zipRepository = $zipRepository;
    }

    /**
     * propertyCostCalculation
     * @param array $data
     * @return int|float
     */
    public function propertyCostCalculation(array $data): int|float
    {
        try {
            $propertyTypeCost = $this->propertyRate($data['property_type_id']);
            $boilerTypeCost = $this->boilerType($data['boiler_type_id']);
            $lastServiceBasedCost = $this->lastService($data['last_service_date']);
            $postCodeCost = $this->postCode($data['zip_id']);
            $radiatorCost = $this->radiator($data['radiator']);

            return $propertyTypeCost + $boilerTypeCost + $lastServiceBasedCost + $postCodeCost + $radiatorCost;
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
            else if ($type == "HMO") $rate = 26;
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
     * @param int $id
     * @return int
     */
    public function boilerType(int $id): int
    {
        try {
            $boilerType = $this->boilerTypeRepository->findBoilerType($id);
            $type = $boilerType->name;
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
            if (is_null($historyDate) || trim($historyDate) === '') {
                return 5;
            }

            $history = Carbon::parse($historyDate);
            $yearsDiff = $history->diffInYears(Carbon::now());

            return match (true) {
                $yearsDiff < 1 => 0,
                $yearsDiff < 2 => 1,
                $yearsDiff < 3 => 2,
                $yearsDiff < 4 => 3,
                default => 5,
            };
        } catch (Exception $e) {
            Log::error('PropertyService::lastService', ['error' => $e->getMessage()]);
            throw $e;
        }
    }

    /**
     * radiator
     * @param int $number
     * @return int
     */
    public function radiator(int $number)
    {
        try {
            if ($number <= 8) {
                return 0;
            }
            if ($number <= 12) {
                return 1;
            }
            return 2;
        } catch (Exception $e) {
            Log::error('PropertyService::radiator', ['error' => $e->getMessage()]);
            throw $e;
        } catch (Exception $e) {
            Log::error('PropertyService::radiator', ['error' => $e->getMessage()]);
            throw $e;
        }
    }

    /**
     * Summary of postCode
     * @param int $id
     * @return int
     */
    public function postCode(int $id)
    {
        try {
            $zip = $this->zipRepository->findZip($id);
            $postCode = $zip->number;
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
