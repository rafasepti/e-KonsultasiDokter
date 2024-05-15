<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;


class NewDataCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $orderChat;

    /**
     * Create a new event instance.
     *
     * @param  \App\Models\OrderChat  $orderChat
     * @return void
     */
    public function __construct($orderChat)
    {
        $this->orderChat = $orderChat;
    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith()
    {
        return [
            'orderChat' => $this->orderChat,
        ];
    }
}
