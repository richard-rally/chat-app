<?php

namespace Tests\Feature\Http\Channel;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoreChannelControllerTest extends TestCase
{
    use WithFaker;
    use DatabaseTransactions;

    public function test_channel_store_controller_returns_401_when_not_authenticated()
    {
        // When
        $response = $this->json('post', route('api.channels.store'), [
            'name' => $this->faker->name,
        ]);

        // Then
        $response->assertStatus(401);
    }

    public function test_channel_store_controller_returns_422_when_name_not_set()
    {
        // Given
        $user = User::factory()->create();

        $this->actingAs($user);

        // When
        $response = $this->json('post', route('api.channels.store'));

        // Then
        $response->assertStatus(422)
            ->assertJsonStructure([
                'errors' => [
                    'name',
                ]
            ]);
    }

    public function test_channel_store_controller_returns_201()
    {
        // Given
        $user = User::factory()->create();

        $this->actingAs($user);

        // When
        $response = $this->json('post', route('api.channels.store'), [
            'name' => $this->faker->name,
        ]);

        // Then
        $response->assertStatus(201)
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
