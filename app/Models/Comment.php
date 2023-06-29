<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class Comment extends Model
{
    use HasFactory;
    public $fillable = ['task_id', 'author_id', 'destinatary_id', 'comment', 'created_at', 'updated_at', 'visibility'];
    
    /**
     * Return the task of the comment
     */
    public function task() : BelongsTo
    {
        return $this->belongsTo(Task::class, 'task_id');
    }
    
    /**
     * Return the author of the comment
     */
    public function author() : BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * Return the destinatary of the comment
     */
    public function destinatary() : BelongsTo
    {
        return $this->belongsTo(User::class, 'destinatary_id');
    }
    
}
