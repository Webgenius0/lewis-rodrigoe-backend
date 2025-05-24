<?php

namespace App\Http\Controllers\Api\V1\Message;

use App\Events\MessageSent;
use App\Http\Controllers\Api\V1\Controller;
use App\Http\Requests\Api\V1\Message\SendRequest;
use App\Models\Message;
use App\Services\Api\V1\Message\MessageService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MessageController extends Controller
{
    /**
     * messageService
     * @var MessageService
     */
    private MessageService $messageService;

    /**
     * __construct
     * @param \App\Services\Api\V1\Message\MessageService $messageService
     */
    public function __construct(MessageService $messageService)
    {
        $this->messageService = $messageService;
    }

    /**
     * send
     * @param \App\Http\Requests\Api\V1\Message\SendRequest $sendRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function send(SendRequest $sendRequest)
    {
        try {
            $validatedData = $sendRequest->validated();
            $response = $this->messageService->sendMessage($validatedData);
            return $this->success(201, 'message successfully send', $response);
        } catch (Exception $e) {
            Log::error("MessageController::send", ['message' => $e->getMessage()]);
            return $this->error(500, 'server error');
        }
    }

    public function conversation($userId)
    {
        $authId = auth()->id();

        $messages = Message::where(function ($q) use ($authId, $userId) {
            $q->where('sender_id', $authId)->where('receiver_id', $userId);
        })->orWhere(function ($q) use ($authId, $userId) {
            $q->where('sender_id', $userId)->where('receiver_id', $authId);
        })->orderBy('created_at')->get();

        return response()->json($messages);
    }
}
