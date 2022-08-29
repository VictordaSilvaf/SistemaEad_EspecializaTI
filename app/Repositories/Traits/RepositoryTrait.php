<?php

namespace App\Repositories\Traits;

use App\Models\User;

trait RepositoryTrait
{
    // Pegando o usuario autentiado.
    private function getUserAuth(): User
    {
        return auth()->user();
    }
}
