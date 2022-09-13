<?php

namespace App\Events;

use App\Models\MeetEventUpdate;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MeetEventUpdateCreatedEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $meetEventUpdate;

    /**
     * Create a new event instance.
     * @return void
     */
    public function __construct(MeetEventUpdate $meetEventUpdate)
    {
        $this->meetEventUpdate = $meetEventUpdate;
    }

    /**
     * Get the channels the event should broadcast on.
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('MeetEventUpdates');
    }
}
