<?php

namespace Tests\Feature\Services;

use App\Events\MessageCreatedEvent;
use App\Models\Channel;
use App\Models\User;
use App\Services\MessageService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class MessageServiceTest extends TestCase
{
    use WithFaker;
    use DatabaseTransactions;

    public function test_create_message()
    {
        // Given
        $service = new MessageService();
        /** @var User $user */
        $user = User::factory()->create();

        Event::fake(MessageCreatedEvent::class);

        /** @var Channel $channel */
        $channel = Channel::factory()->create([
            'name' => $this->faker->name,
        ]);

        // When
        $service->createMessage($channel, $user, [
            'payload' => $payload = $this->faker->paragraph,
        ]);

        // Then
        Event::assertDispatched(MessageCreatedEvent::class);

        $this->assertDatabaseHas('messages', [
            'channel_id' => $channel->getKey(),
            'payload' => $payload,
            'user_id' => $user->getKey(),
        ]);

    }
}
