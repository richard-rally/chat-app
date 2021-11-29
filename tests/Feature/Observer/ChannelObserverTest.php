<?php

namespace Tests\Feature\Observer;

use App\Models\Channel;
use App\Observers\ChannelObserver;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ChannelObserverTest extends TestCase
{
    use DatabaseTransactions;

    public function test_creating()
    {
        // Given.
        $channel = new Channel();

        $observer = new ChannelObserver();

        // When.
        $observer->creating($channel);

        // Then.
        $this->assertNotNull($channel->uuid);
    }
}
