<?php

namespace Tests\Feature\Observer;

use App\Models\Message;
use App\Observers\MessageObserver;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class MessageObserverTest extends TestCase
{
    use DatabaseTransactions;

    public function test_creating()
    {
        // Given.
        $message = new Message();

        $observer = new MessageObserver();

        // When.
        $observer->creating($message);

        // Then.
        $this->assertNotNull($message->uuid);
    }
}
