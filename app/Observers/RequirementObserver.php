<?php

namespace App\Observers;

use App\Models\Requirement;

class RequirementObserver
{
    /**
     * Handle the Requirement "created" event.
     */
    public function created(Requirement $requirement): void
    {
        //
    }

    /**
     * Handle the Requirement "creating" event.
     */
    public function creating(Requirement $requirement): void
    {
        $requirement->created_at = now();
        $requirement->visibility = 1;
        $requirement->autor = 1;//auth()->user()->id;
    }

    /**
     * Handle the Requirement "updated" event.
     */
    public function updated(Requirement $requirement): void
    {
        $requirement->updated_at = now();
    }

    /**
     * Handle the Requirement "deleted" event.
     */
    public function deleted(Requirement $requirement): void
    {
        //
    }

    /**
     * Handle the Requirement "restored" event.
     */
    public function restored(Requirement $requirement): void
    {
        //
    }

    /**
     * Handle the Requirement "force deleted" event.
     */
    public function forceDeleted(Requirement $requirement): void
    {
        //
    }
}
