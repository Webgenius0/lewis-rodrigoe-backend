<?php

namespace App\Http\Controllers\Api\V1\Message;

use App\Events\MessageSent;
use App\Http\Controllers\Api\V1\Controller;
use App\Http\Requests\Api\V1\Message\SendRequest;
use App\Http\Resources\Api\V1\Message\SendResource;
use App\Models\Message;
use App\Models\User;
use App\Services\Api\V1\Message\MessageService;
use Exception;
use Illuminate\Http\JsonResponse;
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
            return $this->success(201, 'message successfully send', new SendResource($response));
        } catch (Exception $e) {
            Log::error("MessageController::send", ['message' => $e->getMessage()]);
            return $this->error(500, 'server error');
        }
    }

    /**
     * conversation
     * @param \App\Models\User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function conversation(User $user): JsonResponse
    {
        try {
            $response = $this->messageService->getConversation($user);
            return $this->success(200, 'message conversation', $response);
        }catch(Exception $e) {
            Log::error("MessageController::conversation", ['message' => $e->getMessage()]);
            return $this->error(500, 'server error');
        }
    }
}
