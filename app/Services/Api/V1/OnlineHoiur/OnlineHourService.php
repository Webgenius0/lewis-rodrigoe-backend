<?php

namespace App\Services\Api\V1\OnlineHoiur;

use App\Interfaces\V1\OnlineHoiur\OnlineHourRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class OnlineHourService
{
    /**
     * onlineHourRepository
     * @var OnlineHourRepositoryInterface
     */
    private OnlineHourRepositoryInterface $onlineHourRepository;
    private $authUser;

    /**
     * construct
     * @param \App\Interfaces\V1\OnlineHoiur\OnlineHourRepositoryInterface $onlineHourRepository
     */
    public function __construct(OnlineHourRepositoryInterface $onlineHourRepository)
    {
        $this->onlineHourRepository = $onlineHourRepository;
        $this->authUser = Auth::user();
    }

    /**
     * getOnlineHours
     * @return \Illuminate\Database\Eloquent\Collection<int, \App\Models\OnlineHour>
     */
    public function getOnlineHours(): \Illuminate\Database\Eloquent\Collection
    {
        try {
            return $this->onlineHourRepository->getOnlineHours();
        } catch (Exception $e) {
            Log::error('OnlineHourService::getOnlineHours ', [$e->getMessage()]);
            throw $e;
        }
    }

    /**
     * pareUser
     * @param array $data
     * @return array{attached: array, detached: array, updated: array}
     */
    public function pareUser(array $data): array
    {
        try {
            return $this->onlineHourRepository->pareUser($this->authUser->id, $data['online_hour_id']);
        } catch (Exception $e) {
            Log::error('OnlineHourService::pareUser ', [$e->getMessage()]);
            throw $e;
        }
    }
}
