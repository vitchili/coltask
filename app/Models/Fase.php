<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Fase extends Model
{
    use HasFactory;

    const WaitingDistribution = 1;
    const UnderReview = 2;
    const InProgress = 3;
    const InTest = 4;
    const InRefactoring = 5;
    const WaitingPublishment = 6;
    const FinishedByDevelopment = 7;
    const FinishedBySupport = 8;
    const Canceled = 9;
    const InactiveWaitingFeedbackFromClient = 10;
    const InactiveOtherReason = 11;

    public $fillable = ['name'];

    /**
     * Return tasks who are in this fase
     */
    public function tasks() : HasMany
    {
        return $this->hasMany(Task::class, 'fase_id');
    }
}
