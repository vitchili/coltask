<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Team extends Model
{
    
    use HasFactory;

    public $fillable = ['name', 'description'];
    
    /**
     * Return users of this team
     */
    public function users() : BelongsToMany
    {
        return $this->belongsToMany(User::class, 'users_teams', 'team_id', 'user_id');
    }

}
