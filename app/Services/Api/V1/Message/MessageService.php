<?php

namespace App\Services\Api\V1\Message;

use App\Events\MessageSent;
use App\Interfaces\V1\Message\MessageRepositoryInterface;
use App\Models\Message;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MessageService
{
    /**
     * messageRepository
     * @var MessageRepositoryInterface
     */
    private MessageRepositoryInterface $messageRepository;
    /**
     * authUser
     * @var \App\Models\User|null
     */
    private User|null $authUser;

    /**
     * __construct
     * @param \App\Interfaces\V1\Message\MessageRepositoryInterface $messageRepository
     */
    public function __construct(MessageRepositoryInterface $messageRepository)
    {
        $this->messageRepository = $messageRepository;

        $this->authUser = Auth::user();
    }

    /**
     * sendMessage
     * @param array $data
     * @return Message
     */
    public function sendMessage(array $data): Message
    {
        try {
            $message =  $this->messageRepository->createMessage($data, $this->authUser->id);
            broadcast(new MessageSent($message, $data['receiver_id']))->toOthers();
            return $message;
        } catch (Exception $e) {
            Log::error('MessageService::sendMessage', ['error' => $e->getMessage()]);
            throw $e;
        }
    }
}
