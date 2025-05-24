<?php

use Illuminate\Support\Facades\Broadcast;

/**
 * Boradcast for chat
 * @return bool
 */
Broadcast::channel('chat.{receiverId}', function ($user, $receiverId)
{
    return (int) $user->id === (int) $receiverId;
});
