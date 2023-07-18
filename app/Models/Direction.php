<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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

    /**
     * Return users of this direction
     */
    public function users() : BelongsToMany
    {
        return $this->belongsToMany(User::class, 'users_directions', 'direction_id', 'user_id');
    }
}
