<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Client;
use App\Models\Fase;
use App\Models\User;


class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'email_copy',
        'outside_requester',
        'type',
        'title',
        'description',
        'direction_id',
        'screen_id',
        'priority_id',
        'dead_line',
        'sponsor_id',
        'started_at',
        'modification',
        'modification_finished_at',
        'branch',
        'qa_id',
        'approved_or_failed',
        'approved_or_failed_by',
        'last_approval',
        'last_failed',
        'deployed',
        'deployed_at',
        'canceled',
        'created_by',
        'created_at',
        'updated_at',
        'fase_id',
        'sprint_id',
        'visibility',
    ];

    protected $casts = [
        'dead_line' => 'datetime',
        'last_approval' => 'datetime',
        'last_failed' => 'datetime',
        'deployed_at' => 'datetime',
    ];
    
    /**
     * Return fase of this task
     */
    public function fase() : BelongsTo
    {
        return $this->belongsTo(Fase::class, 'fase_id');
    }

    /**
     * Return task fase name
     */
    public function getTypeName() : mixed
    {
        return match($this->type){
            'E' => 'Correção de Erro', //error
            'F' => 'Nova Feature', //feature
            'H' => 'Ajuda', //help
            'S' => 'Servico', //service
        };
    }

    /**
     * Return client of this task
     */
    public function client() : BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Return direction of this task
     */
    public function direction() : BelongsTo
    {
        return $this->belongsTo(Direction::class);
    }

    /**
     * Return screen of this task
     */
    public function screen() : ?BelongsTo
    {
        return $this->belongsTo(Screen::class);
    }

    /**
     * Return author of this task
     */
    public function author() : BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

     /**
     * Return priority of this task
     */
    public function priority() : BelongsTo
    {
        return $this->belongsTo(Priority::class, 'priority_id');
    }

    /**
     * Return sponsor of this task
     */
    public function sponsor() : ?BelongsTo
    {
        return $this->belongsTo(User::class, 'sponsor_id');
    }

    /**
     * Return QA of this task
     */
    public function qa() : ?BelongsTo
    {
        return $this->belongsTo(User::class, 'qa_id');
    }

    /**
     * Return sprint of this task
     */
    public function sprint() : ?BelongsTo
    {
        return $this->belongsTo(Sprint::class, 'sprint_id');
    }

}
