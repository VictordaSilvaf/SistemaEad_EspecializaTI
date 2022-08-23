<?php

namespace App\Repositories;

use App\Models\Module;
use App\Models\Support;

class SupportRepository
{
    protected $entity;

    public function __construct(Support $model)
    {
        $this->entity = $model;
    }

    public function getSupports()
    {
        return $this->entity->where('course_id')->get();
    }
}
