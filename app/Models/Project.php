<?php

namespace App\Models;

use App\Models\Sprint;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{

    use HasFactory;

    public $fillable = ['title', 'description', 'created_by'];
    
    /**
     * Return tasks who are in this sprint
     */
    public function sprints() : HasMany
    {
        return $this->hasMany(Sprint::class, 'project_id');
    }
    
}
