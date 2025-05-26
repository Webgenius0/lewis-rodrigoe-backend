<?php

namespace App\Repositories\V1\OnlineHoiur;

use App\Interfaces\V1\OnlineHoiur\OnlineHourRepositoryInterface;
use App\Models\OnlineHour;
use Illuminate\Database\Eloquent\Collection;

class OnlineHourRepository implements OnlineHourRepositoryInterface
{
    /**
     * getOnlineHours
     * @return Collection<int, OnlineHour>
     */
    public function getOnlineHours():Collection
    {
        return OnlineHour::all();
    }
}
