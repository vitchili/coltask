<?php

namespace App\Observers;

use App\Models\Project;

class ProjectObserver
{
    /**
     * Handle the Project "created" event.
     */
    public function created(Project $sprint): void
    {
        //
    }

    /**
     * Handle the Screen "creating" event.
     */
    public function creating(Project $sprint): void
    {
        $sprint->created_by = 1;
        $sprint->created_at = now();
        $sprint->updated_at = now();
    }

    /**
     * Handle the Screen "updated" event.
     */
    public function updated(Project $sprint): void
    {
        $sprint->updated_at = now();
    }

    /**
     * Handle the Project "deleted" event.
     */
    public function deleted(Project $sprint): void
    {
        //
    }

    /**
     * Handle the Project "restored" event.
     */
    public function restored(Project $sprint): void
    {
        //
    }

    /**
     * Handle the Project "force deleted" event.
     */
    public function forceDeleted(Project $sprint): void
    {
        //
    }
}
