<?php

namespace Tests\Feature\Api;

use App\Models\Support;
use Tests\TestCase;

class SupportTest extends TestCase
{
    use UtilsTrait;

    public function test_get_my_supports_unauthenticated()
    {
        $response = $this->getJson('/supports/my');

        $response->assertStatus(401);
    }

    public function test_get_my_supports()
    {
        $user = $this->createUser();
        $token = $user->createToken('teste')->plainTextToken;

        Support::factory()->count(50)->create([
            'user_id' => $user->id,
        ]);

        Support::factory()->count(50)->create();

        $response = $this->getJson('/supports/my', [
            'Authorization' => "Bearer {$token}"
        ]);

        $response->assertStatus(200)
            ->assertJsonCount(50, 'data');
    }
}
