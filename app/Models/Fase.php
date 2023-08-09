<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Fase extends Model
{
    use HasFactory;

    public $fillable = ['name', 'description', 'hex_color'];

    const WAITING_DISTRIBUTION = 1;
    const UNDER_REVIEW = 2;
    const IN_PROGRESS = 3;
    const IN_TEST = 4;
    const IN_REFACTORING = 5;
    const WAITING_PUBLISHMENT = 6;
    const FINISHED_BY_DEVELOPMENT = 7;
    const FINISHED_BY_SUPPORT = 8;
    const CANCELED = 9;
    const INACTIVE_WAITING_FEEDBACK = 10;
    const INACTIVE_OTHER_REASON = 11;

    /**
     * Return tasks who are in this fase
     */
    public function tasks() : HasMany
    {
        return $this->hasMany(Task::class, 'fase_id');
    }
}
