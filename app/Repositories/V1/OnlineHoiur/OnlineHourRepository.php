<?php

namespace App\Repositories\V1\OnlineHoiur;

use App\Interfaces\V1\OnlineHoiur\OnlineHourRepositoryInterface;
use App\Models\OnlineHour;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;

class OnlineHourRepository implements OnlineHourRepositoryInterface
{
    /**
     * getOnlineHours
     * @return Collection<int, OnlineHour>
     */
    public function getOnlineHours(): Collection
    {
        try {
            return OnlineHour::all();
        } catch (Exception $e) {
            Log::error('OnlineHourRepository::getOnlineHours ', [$e->getMessage()]);
            throw $e;
        }
    }
}
