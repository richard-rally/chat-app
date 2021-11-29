<?php

namespace Tests\Feature\Services;

use App\Events\ChannelCreatedEvent;
use App\Events\ChannelDeletedEvent;
use App\Events\ChannelUpdatedEvent;
use App\Models\Channel;
use App\Services\ChannelService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class ChannelServiceTest extends TestCase
{
    use WithFaker;
    use DatabaseTransactions;

    public function test_create_channel()
    {
        // Given
        $service = new ChannelService();

        Event::fake(ChannelCreatedEvent::class);

        // When
        $service->createChannel([
            'name' => $name = $this->faker->name,
        ]);

        // Then
        Event::assertDispatched(ChannelCreatedEvent::class);

        $this->assertDatabaseHas('channels', [
            'name' => $name
        ]);

    }

    public function test_update_channel()
    {
        // Given
        $service = new ChannelService();

        /** @var Channel $channel */
        $channel = Channel::factory()->create([
            'name' => $this->faker->name,
        ]);

        Event::fake(ChannelUpdatedEvent::class);

        // When
        $service->updateChannel($channel, [
            'name' => $name = $this->faker->name,
        ]);

        // Then
        Event::assertDispatched(ChannelUpdatedEvent::class);

        $this->assertDatabaseHas('channels', [
            'uuid' => $channel->uuid,
            'name' => $name,
        ]);

    }

    public function test_delete_channel()
    {
        // Given
        $service = new ChannelService();

        /** @var Channel $channel */
        $channel = Channel::factory()->create([
            'name' => $this->faker->name,
        ]);

        Event::fake(ChannelDeletedEvent::class);

        // When
        $service->deleteChannel($channel);

        // Then
        Event::assertDispatched(ChannelDeletedEvent::class);

        $this->assertDatabaseMissing('channels', [
            'uuid' => $channel->uuid
        ]);

    }
}
