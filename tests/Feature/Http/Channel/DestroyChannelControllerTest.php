<?php

namespace Tests\Feature\Http\Channel;

use App\Models\Channel;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DestroyChannelControllerTest extends TestCase
{
    use WithFaker;
    use DatabaseTransactions;

    public function test_channel_destroy_controller_returns_401_when_not_authenticated()
    {
        // Given
        $channel = Channel::factory()->create([
            'name' => $this->faker->name,
        ]);

        // When
        $response = $this->json('delete', route('api.channels.destroy', ['channel' => $channel]));

        // Then
        $response->assertStatus(401);
    }

    public function test_channel_destroy_controller_returns_204()
    {
        // Given
        $user = User::factory()->create();

        $this->actingAs($user);

        $channel = Channel::factory()->create([
            'name' => $this->faker->name,
        ]);

        // When
        $response = $this->json('delete', route('api.channels.destroy', ['channel' => $channel->uuid]));

        // Then
        $response->assertStatus(204);
    }
}
