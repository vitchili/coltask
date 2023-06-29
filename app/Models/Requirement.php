<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Requirement extends Model
{
    use HasFactory;

    public $fillable = ['task_id', 'author_id', 'requirement_description', 'solution_flow', 'obs_development', 'visibility'];

    /**
     * Return tasks of the requirement
     */
    public function task() : BelongsTo
    {
        return $this->belongsTo(Task::class, 'task_id');
    }

    /**
     * Return author of the requirement
     */
    public function author() : BelongsTo
    {
        return $this->belongsTo(User::class, 'task_id');
    }

}
