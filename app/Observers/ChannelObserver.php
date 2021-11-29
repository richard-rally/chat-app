<?php

namespace App\Observers;

use App\Models\Channel;
use Illuminate\Support\Str;

class ChannelObserver
{
    /**
     * @param Channel $channel
     */
    public function creating(Channel $channel)
    {
        $channel->uuid = Str::uuid();
    }
}
