<?php

namespace App\Services\Api\V1\Boiler\Model;

use App\Interfaces\V1\Boiler\Model\BoilerModelRepositoryInterface;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;

class BoilerModelService
{
    /**
     * boilerModelRepository
     * @var BoilerModelRepositoryInterface
     */
    private BoilerModelRepositoryInterface $boilerModelRepository;

    /**
     * construct
     * @param \App\Interfaces\V1\Boiler\Model\BoilerModelRepositoryInterface $boilerModelRepository
     */
    public function __construct(BoilerModelRepositoryInterface $boilerModelRepository)
    {
        $this->boilerModelRepository = $boilerModelRepository;
    }

    /**
     * getBoilerModelIndex
     * @return \Illuminate\Database\Eloquent\Collection<int, \App\Models\BoilerModel>
     */
    public function getBoilerModelIndex(): Collection
    {
        try {
            return $this->boilerModelRepository->getBoilerModels();
        } catch (Exception $e) {
            Log::error('BoilerTypeService::boilerTypeIndex', ['error' => $e->getMessage()]);
            throw $e;
        }
    }
}
