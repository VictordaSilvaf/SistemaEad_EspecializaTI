<?php

namespace App\Repositories;

use App\Models\Support;
use App\Models\User;
use Illuminate\Support\Arr;

class SupportRepository
{
    protected $entity;

    public function __construct(Support $model)
    {
        $this->entity = $model;
    }

    public function getSupports(array $filters = [])
    {
        return $this->getUserAuth()
            ->supports()
            ->where(function ($query) use ($filters) {
                if (isset($filters['lesson'])) {
                    $query->where('lesson_id', $filters['lesson']);
                }

                if (isset($filters['status'])) {
                    $query->where('status', $filters['status']);
                }

                if (isset($filters['filter'])) {
                    $filter = $filters['filter'];
                    $query->where('description', "LIKE", "%{$filter}%");
                }
            })
            ->get();
    }

    public function createNewSupport(array $data): Support
    {
        $support = $this->getUserAuth()
            ->supports()
            ->create([
                'status' => $data['status'],
                'lesson_id' => $data['lesson'],
                'description' => $data['description'],
            ]);

        return $support;
    }

    // Pegando o usuario autentiado.
    private function getUserAuth(): User
    {
        // return auth()->user();
        return User::first();
    }
}
