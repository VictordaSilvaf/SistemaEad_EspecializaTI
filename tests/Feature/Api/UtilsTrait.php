<?php

namespace Tests\Feature\Api;

use App\Models\User;

trait UtilsTrait
{
    public function createUser()
    {
        return User::factory()->create();
    }

    public function createTokenUser()
    {
        $user = $this->createUser();
        return $user->createToken('teste')->plainTextToken;
    }

    public function defaultHeaders()
    {
        $token = $this->createTokenUser();

        return [
            'Authorization' => "Bearer {$token}",
        ];
    }
}
