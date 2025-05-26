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

    /**
     * pareUser
     * @param int $authUserId
     * @param int $onlineHourId
     * @return array{attached: array, detached: array, updated: array}
     */
    public function pareUser(int $authUserId, int $onlineHourId):array;
}
