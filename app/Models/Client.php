<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Task;

class Client extends Model
{
    use HasFactory;

    public $fillable = ['name', 'visibility'];
    /**
     * Return tasks of the client
     */
    public function tasks() : HasMany
    {
        return $this->hasMany(Task::class);
    }

}
