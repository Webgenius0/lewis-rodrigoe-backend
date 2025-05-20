<?php

namespace App\Interfaces\V1\Boiler\Type;

use App\Models\BoilerTypes;
use Illuminate\Database\Eloquent\Collection;

interface BoilerTypeRepositoryInterface
{
    /**
     * getBoilerTypes
     * @return \Illuminate\Database\Eloquent\Collection<int, BoilerTypes>
     */
    public function getBoilerTypes(): Collection;
}
