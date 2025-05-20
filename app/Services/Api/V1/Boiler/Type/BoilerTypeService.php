<?php

namespace App\Services\Api\V1\Boiler\Type;

use App\Interfaces\V1\Boiler\Type\BoilerTypeRepositoryInterface;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;

class BoilerTypeService
{
    /**
     * boilerTypeRepository
     * @var BoilerTypeRepositoryInterface
     */
    private BoilerTypeRepositoryInterface $boilerTypeRepository;

    /**
     * __construct
     * @param \App\Interfaces\V1\Boiler\Type\BoilerTypeRepositoryInterface $boilerTypeRepository
     */
    public function __construct(BoilerTypeRepositoryInterface $boilerTypeRepository)
    {
        $this->boilerTypeRepository = $boilerTypeRepository;
    }

    /**
     * boilerTypeIndex
     * @return \Illuminate\Database\Eloquent\Collection<int, \App\Models\BoilerTypes>
     */
    public function boilerTypeIndex(): Collection
    {
        try {
            return $this->boilerTypeRepository->getBoilerTypes();
        } catch (Exception $e) {
            Log::error('BoilerTypeService::boilerTypeIndex', ['error' => $e->getMessage()]);
            throw $e;
        }
    }
}
