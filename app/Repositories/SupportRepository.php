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
        return $this->entity
            ->where(function ($query) use ($filters) {
                if (isset($filters['lesson'])) {
                    $query->where('lesson_id', $filters['lesson']);
                }

                if (isset($filters['status'])) {
                    $query->where('status', $filters['status']);
                }

                if (isset($filters['filter'])) {
                    $filter = $filters['filter'];
                    $query->where('description', 'LIKE', "%{$filter}%");
                }

                if (isset($filters['user'])) {
                    $user = $this->getUserAuth();

                    $query->where('user_id', $user->id);
                }
            })
            ->with('replies')
            ->orderBy('updated_at')
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

    public function ReplyResource(string $supportId, array $data)
    {
        $user = $this->getUserAuth();

        $this->getSupport($supportId)
            ->replies()
            ->create([
                'description' => $data['desription'],
                'user_id' => $user->id,
            ]);
    }

    private function getSupport(string $id)
    {
        return $this->entity->findOrFail($id);
    }

    public function createReplyToSupportId(string $supportId, array $data)
    {
        $user = $this->getUserAuth();

        return $this->getSupport($supportId)
            ->replies()
            ->create([
                'description' => $data['description'],
                'user_id' => $user->id,
            ]);
    }

    // Pegando o usuario autentiado.
    private function getUserAuth(): User
    {
        // return auth()->user();
        return User::first();
    }
}
