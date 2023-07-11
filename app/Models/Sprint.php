<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sprint extends Model
{
    
    use HasFactory;

    public $fillable = ['title', 'description', 'dead_line', 'project_id', 'created_by'];
    /**
     * Return tasks who are in this sprint
     */
    public function tasks() : HasMany
    {
        return $this->hasMany(Task::class, 'sprint_id');
    }

    /**
     * Return module of this screen
     */
    public function project() : BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

}
