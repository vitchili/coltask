<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Direction extends Model
{
    use HasFactory;

    public $fillable = ['name', 'slang'];

    /**
     * Return tasks who are in this fase
     */
    public function tasks() : HasMany
    {
        return $this->hasMany(Task::class, 'direction_id');
    }
}
