<?php

namespace App\Observers;

use App\Models\Sprint;

class SprintObserver
{
    /**
     * Handle the Sprint "created" event.
     */
    public function created(Sprint $sprint): void
    {
        //
    }

    /**
     * Handle the Screen "creating" event.
     */
    public function creating(Sprint $sprint): void
    {
        $sprint->created_by = 1;
        $sprint->created_at = now();
        $sprint->updated_at = now();
    }

    /**
     * Handle the Screen "updated" event.
     */
    public function updated(Sprint $sprint): void
    {
        $sprint->updated_at = now();
    }

    /**
     * Handle the Sprint "deleted" event.
     */
    public function deleted(Sprint $sprint): void
    {
        //
    }

    /**
     * Handle the Sprint "restored" event.
     */
    public function restored(Sprint $sprint): void
    {
        //
    }

    /**
     * Handle the Sprint "force deleted" event.
     */
    public function forceDeleted(Sprint $sprint): void
    {
        //
    }
}
