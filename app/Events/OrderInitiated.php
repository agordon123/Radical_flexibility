<?php

namespace App\Events;

use App\Models\Order;
use App\Enums\OrderStatus;
use App\Models\Painting;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class OrderInitiated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $painting;
    /**
     * Create a new event instance.
     */
    public function __construct(Painting $painting)
    {
            return $this->painting = $painting;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('orders'),
        ];
    }
}
