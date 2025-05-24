<?php

namespace App\Http\Resources\Api\V1\Message;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SendResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = parent::toArray($request);

        return [
            'id'          => $data['id'],
            'receiver_id' => $data['receiver_id'],
            'content'     => $data['content'],
            'sender'      => [
                'id'         => $data['sender']['id'],
                'first_name' => $data['sender']['first_name'],
                'last_name'  => $data['sender']['last_name'],
                'avatar'     => $data['sender']['avatar'],
            ],
        ];
    }
}
