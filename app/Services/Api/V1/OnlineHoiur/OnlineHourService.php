<?php

namespace App\Services\Api\V1\OnlineHoiur;

use App\Interfaces\V1\OnlineHoiur\OnlineHourRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\Log;

class OnlineHourService
{
    /**
     * onlineHourRepository
     * @var OnlineHourRepositoryInterface
     */
    private OnlineHourRepositoryInterface $onlineHourRepository;

    /**
     * construct
     * @param \App\Interfaces\V1\OnlineHoiur\OnlineHourRepositoryInterface $onlineHourRepository
     */
    public function __construct(OnlineHourRepositoryInterface $onlineHourRepository)
    {
        $this->onlineHourRepository = $onlineHourRepository;
    }

    /**
     * getOnlineHours
     * @return \Illuminate\Database\Eloquent\Collection<int, \App\Models\OnlineHour>
     */
    public function getOnlineHours(): \Illuminate\Database\Eloquent\Collection
    {
        try {
            return $this->onlineHourRepository->getOnlineHours();
        }catch (Exception $e) {
            Log::error('OnlineHourService::getOnlineHours ', [$e->getMessage()]);
            throw $e;
        }
    }
}
