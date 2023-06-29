<?php

namespace App\Observers;

use App\Models\Priority;

class PriorityObserver
{
    /**
     * Handle the Priority "created" event.
     */
    public function created(Priority $priority): void
    {
        //
    }

    /**
     * Handle the Priority "creating" event.
     */
    public function creating(Priority $priority): void
    {
        $priority->created_at = now();
        $priority->visibility = 1;
    }

    /**
     * Handle the Priority "updated" event.
     */
    public function updated(Priority $priority): void
    {
        $priority->updated_at = now();
    }

    /**
     * Handle the Priority "deleted" event.
     */
    public function deleted(Priority $priority): void
    {
        //
    }

    /**
     * Handle the Priority "restored" event.
     */
    public function restored(Priority $priority): void
    {
        //
    }

    /**
     * Handle the Priority "force deleted" event.
     */
    public function forceDeleted(Priority $priority): void
    {
        //
    }
}
