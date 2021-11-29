<?php

namespace App\Services;

use App\Contracts\ChannelServiceContract;
use App\Contracts\MessageServiceContract;
use App\Events\ChannelCreatedEvent;
use App\Events\ChannelDeletedEvent;
use App\Events\ChannelUpdatedEvent;
use App\Events\MessageCreatedEvent;
use App\Models\Channel;
use App\Models\Message;
use App\Models\User;

class MessageService implements MessageServiceContract
{
    /**
     * @inheritDoc
     */
    public function createMessage(Channel $channel, User $user, array $data): Message
    {
        /** @var Message $message */
        $message = $channel->messages()->make($data);
        $message->user()->associate($user);

        $message->save();

        MessageCreatedEvent::broadcast($message)->toOthers();

        return $message;
    }
}