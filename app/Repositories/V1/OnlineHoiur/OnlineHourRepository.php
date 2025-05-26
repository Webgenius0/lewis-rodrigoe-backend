<?php

namespace App\Repositories\V1\OnlineHoiur;

use App\Interfaces\V1\OnlineHoiur\OnlineHourRepositoryInterface;
use App\Models\OnlineHour;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
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

    /**
     * pareUser
     * @param int $authUserId
     * @param int $onlineHourId
     * @return array{attached: array, detached: array, updated: array}
     */
    public function pareUser(int $authUserId, int $onlineHourId): array
    {
        DB::beginTransaction();
        try {
            $onlineHour = OnlineHour::findOrFail($onlineHourId);
            User::findOrFail($authUserId)->onlineHours()->detach();

            $response = $onlineHour->users()->syncWithoutDetaching([
                $authUserId => ['created_at' => now(), 'updated_at' => now()]
            ]);

            DB::commit();
            return $response;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('BoilerModelRepository::pareUser', ['error' => $e->getMessage()]);
            throw $e;
        }
    }
}
