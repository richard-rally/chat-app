<?php

namespace Tests\Feature\Http\Channel;

use App\Models\Channel;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IndexChannelControllerTest extends TestCase
{
    use WithFaker;
    use DatabaseTransactions;

    public function test_channel_index_controller_returns_401_when_unauthenticated()
    {
        // Given
        Channel::factory(3)->create([
            'name' => $this->faker->name,
        ]);

        // When
        $response = $this->json('get', route('api.channels.index'));

        // then
        $response->assertStatus(401);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_channel_index_controller_returns_200()
    {
        // Given
        $user = User::factory()->create();

        $this->actingAs($user);

        Channel::factory(3)->create([
            'name' => $this->faker->name,
        ]);

        // When
        $response = $this->json('get', route('api.channels.index'));

        // then
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    [
                        'uuid',
                        'name',
                        'created_at',
                        'updated_at',
                    ]
                ]
            ]);
    }
}
