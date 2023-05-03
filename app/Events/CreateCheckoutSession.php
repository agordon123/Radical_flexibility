<?php

namespace App\Events;

use App\Models\CheckoutSession;
use App\Models\Painting;
use Illuminate\Broadcasting\Channel;
use Illuminate\Support\Facades\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Queue\ShouldQueue;


class CreateCheckoutSession implements ShouldQueue
{
    use SerializesModels,InteractsWithSockets,Dispatchable;
    public $session;
    public $painting;
    public function __construct(CheckoutSession $session,Painting $painting)
    {
        $this->session = $session;
        $this->painting= $painting;
    }
        /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('redis'),
        ];
    }
}
