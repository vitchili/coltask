<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Priority extends Model
{
    use HasFactory;

    public $fillable = ['name', 'hex_color', 'is_a_bug', 'visibility'];
    /**
     * Return tasks of the priority
     */
    public function tasks() : HasMany
    {
        return $this->hasMany(Task::class, 'priority_id');
    }
}
