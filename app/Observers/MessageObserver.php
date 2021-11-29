<?php

namespace App\Observers;

use App\Models\Message;
use Illuminate\Support\Str;

class MessageObserver
{
    /**
     * @param Message $message
     */
    public function creating(Message $message)
    {
        $message->uuid = Str::uuid();
    }
}
