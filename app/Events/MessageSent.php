<?php

namespace App\Events;

use App\Models\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class MessageSent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $message;
    public $receiverId;
    /**
     * Create a new event instance.
     */
    public function __construct($message, $receiverId)
    {
        $this->message = $message;
        $this->receiverId = $receiverId;
    }

    public function broadcastOn()
    {
        // return new PrivateChannel('App.Models.User.' . $this->receiverId);
        return new PrivateChannel('chat.' . $this->receiverId);
    }

    public function broadcastWith()
    {
        return ['message' => $this->message->load('sender')];
    }
}
