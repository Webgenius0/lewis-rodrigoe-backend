<?php

namespace App\Interfaces\V1\Message;

use App\Models\Message;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface MessageRepositoryInterface
{
    /**
     * createMessage
     * @param array $data
     * @param int $authId
     * @return Message
     */
    public function createMessage(array $data, int $authId): Message;

    /**
     * getConversaton
     * @param int $authId
     * @param int $receverId
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getConversaton(int $authId, int $receverId): LengthAwarePaginator;
}
