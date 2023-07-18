<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // /**
    //  * The attributes that should be cast.
    //  *
    //  * @var array<string, string>
    //  */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];

    // /**
    //  * The attributes that should be cast.
    //  *
    //  * @var array<string, string>
    //  */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];

    /**
     * Return tasks of the user
     */
    public function tasks() : HasMany
    {
        return $this->hasMany(Task::class, 'created_by');
    }

     /**
     * Return comments o the user
     */
    public function comments() : HasMany
    {
        return $this->hasMany(Comment::class, 'autor');
    }

    /**
     * Return tasks who this user is sponsor
     */
    public function tasksSponsor() : HasMany
    {
        return $this->hasMany(Task::class, 'sponsor_id');
    }

    /**
     * Return teams of this user
     */
    public function teams() : BelongsToMany
    {
        return $this->belongsToMany(Team::class, 'users_teams', 'user_id', 'team_id');
    }

    /**
     * Return directions of this user //OFFICE ROLE, CARGO
     */
    public function directions() : BelongsToMany
    {
        return $this->belongsToMany(Direction::class, 'users_directions', 'user_id', 'direction_id');
    }

}
