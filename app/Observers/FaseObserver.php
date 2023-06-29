<?php

namespace App\Observers;

use App\Models\Fase;

class FaseObserver
{
    /**
     * Handle the Fase "created" event.
     */
    public function created(Fase $fase): void
    {
        //
    }

    /**
     * Handle the Fase "creating" event.
     */
    public function creating(Fase $fase): void
    {
        $fase->created_at = now();
        $fase->visibility = 1;
    }

    /**
     * Handle the Fase "updated" event.
     */
    public function updated(Fase $fase): void
    {
        $fase->updated_at = now();
    }

    /**
     * Handle the Fase "deleted" event.
     */
    public function deleted(Fase $fase): void
    {
        //
    }

    /**
     * Handle the Fase "restored" event.
     */
    public function restored(Fase $fase): void
    {
        //
    }

    /**
     * Handle the Fase "force deleted" event.
     */
    public function forceDeleted(Fase $fase): void
    {
        //
    }
}
