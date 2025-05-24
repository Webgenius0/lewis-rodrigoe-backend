<?php

namespace App\Http\Controllers\Api\V1\Message;

use App\Events\MessageSent;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController
{
    public function send(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'content' => 'required|string',
        ]);

        $message = Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $request->receiver_id,
            'content' => $request->content,
        ]);

        broadcast(new MessageSent($message, $request->receiver_id))->toOthers();

        return response()->json($message->load('sender'));
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
