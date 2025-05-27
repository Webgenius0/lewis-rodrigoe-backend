<?php

namespace App\Interfaces\V1\Boiler\Model;

use App\Models\BoilerModel;
use Illuminate\Database\Eloquent\Collection;

interface BoilerModelRepositoryInterface
{
    /**
     * getBoilerModels
     * @return \Illuminate\Database\Eloquent\Collection<int, BoilerModel>
     */
    public function getBoilerModels(): Collection;

    /**
     * getBoilerModelById
     * @param int $id
     * @return BoilerModel
     */
    public function getBoilerModelById(int $id): BoilerModel;
}
