<?php

namespace Tests\Feature\Http\Channel\Message;

use App\Models\Channel;
use App\Models\Message;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IndexMessageControllerTest extends TestCase
{
    use WithFaker;
    use DatabaseTransactions;

    public function test_message_index_controller_returns_401_when_unauthenticated()
    {
        // Given
        $user = User::factory()->create();

        $channel = Channel::factory()->create([
            'name' => $this->faker->name,
        ]);

        $messages = Message::factory(3)->create([
            'payload' => $this->faker->sentence,
            'channel_id' => $channel->getKey(),
            'user_id' => $user->getKey()
        ]);

        // When
        $response = $this->json('get', route('api.channels.messages.index', ['channel' => $channel]));

        // then
        $response->assertStatus(401);
    }

    public function test_message_index_controller_returns_200_when_authenticated()
    {
        // Given
        $user = User::factory()->create();

        $channel = Channel::factory()->create([
            'name' => $this->faker->name,
        ]);

        $messages = Message::factory(3)->create([
            'payload' => $this->faker->sentence,
            'channel_id' => $channel->getKey(),
            'user_id' => $user->getKey()
        ]);

        $this->actingAs($user);

        // When
        $response = $this->json('get', route('api.channels.messages.index', ['channel' => $channel]));

        // then
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    [
                        'uuid',
                        'payload',
                        'user',
                        'created_at',
                        'updated_at',
                    ]
                ]
            ]);
    }
}
