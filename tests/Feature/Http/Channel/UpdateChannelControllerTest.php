<?php

namespace Tests\Feature\Http\Channel;

use App\Models\Channel;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateChannelControllerTest extends TestCase
{
    use WithFaker;
    use DatabaseTransactions;

    public function test_channel_update_controller_returns_401_when_not_authenticated()
    {
        // Given
        $channel = Channel::factory()->create([
            'name' => $this->faker->name,
        ]);

        // When
        $response = $this->json('patch', route('api.channels.update', ['channel' => $channel]), [
            'name' => $this->faker->name,
        ]);

        // Then
        $response->assertStatus(401);
    }

    public function test_channel_update_controller_returns_422_when_name_not_set()
    {
        // Given
        $user = User::factory()->create();

        $this->actingAs($user);

        $channel = Channel::factory()->create([
            'name' => $this->faker->name,
        ]);

        // When
        $response = $this->json('patch', route('api.channels.update', ['channel' => $channel]),);

        // Then
        $response->assertStatus(422)
            ->assertJsonStructure([
                'errors' => [
                    'name',
                ]
            ]);
    }

    public function test_channel_update_controller_returns_200()
    {
        // Given
        $user = User::factory()->create();

        $this->actingAs($user);

        $channel = Channel::factory()->create([
            'name' => $this->faker->name,
        ]);

        // When
        $response = $this->json('patch', route('api.channels.update', ['channel' => $channel]), [
            'name' => $this->faker->name,
        ]);

        // Then
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'uuid',
                    'name',
                    'created_at',
                    'updated_at',
                ]
            ]);
    }
}
