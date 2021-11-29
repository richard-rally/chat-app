<?php

namespace Tests\Feature\Http\Channel\Message;

use App\Models\Channel;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoreMessageControllerTest extends TestCase
{
    use WithFaker;
    use DatabaseTransactions;

    public function test_message_store_controller_returns_401_when_not_authenticated()
    {
        //Given
        $channel = Channel::factory()->create();

        // When
        $response = $this->json('post', route('api.channels.messages.store', [
            'channel' => $channel
        ]));

        // Then
        $response->assertStatus(401);
    }

    public function test_message_store_controller_returns_422_when_payload_not_set()
    {
        // Given
        $user = User::factory()->create();
        $channel = Channel::factory()->create();

        $this->actingAs($user);

        // When
        $response = $this->json('post', route('api.channels.messages.store', [
            'channel' => $channel
        ]));

        // Then
        $response->assertStatus(422)
            ->assertJsonStructure([
                'errors' => [
                    'payload',
                ]
            ]);
    }

    public function test_message_store_controller_returns_201()
    {
        // Given
        $user = User::factory()->create();

        $channel = Channel::factory()->create();

        $this->actingAs($user);

        // When
        $response = $this->json('post', route('api.channels.messages.store', [
            'channel' => $channel
        ]), [
            'payload' => $this->faker->sentence
        ]);

        // Then
        $response->assertStatus(201)
            ->assertJsonStructure([
                'data' => [
                    'uuid',
                    'payload',
                    'user',
                    'created_at',
                    'updated_at',
                ]
            ]);
    }
}
