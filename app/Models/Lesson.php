<?php

namespace App\Models;

use App\Models\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory, UuidTrait;

    public $incrementing = false;
    protected $keyTypes = 'uuid';
    protected $fillable = ['nome', 'description', 'video'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
