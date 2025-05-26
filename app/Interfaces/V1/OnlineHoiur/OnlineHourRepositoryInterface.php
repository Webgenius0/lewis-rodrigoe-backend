<?php

namespace App\Interfaces\V1\OnlineHoiur;

use App\Models\OnlineHour;
use Illuminate\Database\Eloquent\Collection;

interface OnlineHourRepositoryInterface
{
    /**
     * getOnlineHours
     * @return Collection<int, OnlineHour>
     */
    public function getOnlineHours(): Collection;
}
