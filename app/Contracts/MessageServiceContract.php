<?php

namespace App\Contracts;

use App\Models\Channel;
use App\Models\Message;
use App\Models\User;

interface MessageServiceContract
{
    /**
     * Create a message and broadcast an event
     *
     * @param Channel $channel
     * @param User $user
     * @param array $data
     *
     * @return Message
     */
    public function createMessage(Channel $channel, User $user, array $data): Message;
}