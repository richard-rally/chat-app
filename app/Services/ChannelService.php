<?php

namespace App\Services;

use App\Contracts\ChannelServiceContract;
use App\Events\ChannelCreatedEvent;
use App\Events\ChannelDeletedEvent;
use App\Events\ChannelUpdatedEvent;
use App\Models\Channel;

class ChannelService implements ChannelServiceContract
{
    /**
     * @inheritDoc
     */
    public function createChannel(array $data): Channel
    {
        $channel = Channel::create($data);

        ChannelCreatedEvent::broadcast($channel)->toOthers();

        return $channel;
    }

    /**
     * @inheritDoc
     */
    public function updateChannel(Channel $channel, array $data): Channel
    {
        $channel->update($data);

        ChannelUpdatedEvent::broadcast($channel)->toOthers();

        return $channel;
    }

    /**
     * @inheritDoc
     */
    public function deleteChannel(Channel $channel): bool
    {
        $result = $channel->delete();

        ChannelDeletedEvent::broadcast($channel)->toOthers();

        return $result;
    }
}