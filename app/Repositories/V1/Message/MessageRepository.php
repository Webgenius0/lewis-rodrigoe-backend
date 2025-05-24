<?php

namespace App\Repositories\V1\Message;

use App\Interfaces\V1\Message\MessageRepositoryInterface;
use App\Models\Message;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

class MessageRepository implements MessageRepositoryInterface
{
    /**
     * createMessage
     * @param array $data
     * @param int $authId
     * @return Message
     */
    public function createMessage(array $data, int $authId): Message
    {
        try {
            return Message::create([
                'sender_id' => $authId,
                'receiver_id' => $data['receiver_id'],
                'content' => $data['content'],
            ]);
        } catch (Exception $e) {
            Log::error('MessageRepository::createMessage', ['error' => $e->getMessage()]);
            throw $e;
        }
    }

    /**
     * getConversaton
     * @param int $authId
     * @param int $receverId
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getConversaton(int $authId, int $receverId): LengthAwarePaginator
    {
        try {
            return Message::where(function ($q) use ($authId, $receverId) {
                $q->where('sender_id', $authId)->where('receiver_id', $receverId);
            })->orWhere(function ($q) use ($authId, $receverId) {
                $q->where('sender_id', $receverId)->where('receiver_id', $authId);
            })->orderBy('created_at')->paginate(50);
        } catch (Exception $e) {
            Log::error('MessageRepository::getConversaton', ['error' => $e->getMessage()]);
            throw $e;
        }
    }
}
