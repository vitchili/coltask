<?php

namespace App\Observers;

use App\Models\Team;

class TeamObserver
{
    /**
     * Handle the Team "created" event.
     */
    public function created(Team $team): void
    {
        //
    }

    /**
     * Handle the Screen "creating" event.
     */
    public function creating(Team $team): void
    {
        $team->created_at = now();
        $team->updated_at = now();
    }

    /**
     * Handle the Screen "updated" event.
     */
    public function updated(Team $team): void
    {
        $team->updated_at = now();
    }

    /**
     * Handle the Team "deleted" event.
     */
    public function deleted(Team $team): void
    {
        //
    }

    /**
     * Handle the Team "restored" event.
     */
    public function restored(Team $team): void
    {
        //
    }

    /**
     * Handle the Team "force deleted" event.
     */
    public function forceDeleted(Team $team): void
    {
        //
    }
}
