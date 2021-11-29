<?php

namespace App\Events;

use App\Http\Resources\ChannelResource;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChannelCreatedEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(protected \App\Models\Channel $channel)
    {
        //
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('chat-channels');
    }

    /**
     * @return string
     */
    public function broadcastAs()
    {
        return 'created';
    }

    /**
     * @return array
     */
    public function broadcastWith()
    {
        return ChannelResource::make($this->channel)->toArray(null);
    }
}
