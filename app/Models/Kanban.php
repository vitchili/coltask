<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kanban extends Model
{
    use HasFactory;

    public $fillable = ['user_id', 'sprint_id'];
    
    /**
     * Return the user from this kanban
     */
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Return the sprint from this kanban
     */
    public function sprint() : ?BelongsTo
    {
        return $this->belongsTo(Sprint::class, 'sprint_id');
    }

}
