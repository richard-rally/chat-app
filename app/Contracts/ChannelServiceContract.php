<?php

namespace App\Contracts;

use App\Models\Channel;

interface ChannelServiceContract
{
    /**
     * Create a channel and broadcast an event
     *
     * @param array $data
     *
     * @return Channel
     */
    public function createChannel(array $data): Channel;

    /**
     * Update a channel and broadcast an event
     *
     * @param Channel $channel
     * @param array $data
     *
     * @return Channel
     */
    public function updateChannel(Channel $channel, array $data): Channel;

    /**
     * Delete a channel and broadcast an event
     *
     * @param Channel $channel
     * @return bool
     */
    public function deleteChannel(Channel $channel): bool;
}