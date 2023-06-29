<?php

namespace App\Observers;

use App\Models\Screen;

class ScreenObserver
{
    /**
     * Handle the Screen "created" event.
     */
    public function created(Screen $screen): void
    {
        //
    }

    /**
     * Handle the Screen "creating" event.
     */
    public function creating(Screen $screen): void
    {
        $screen->created_at = now();
        $screen->updated_at = now();
        $screen->visibility = 1;
    }

    /**
     * Handle the Screen "updated" event.
     */
    public function updated(Screen $screen): void
    {
        $screen->updated_at = now();
    }

    /**
     * Handle the Screen "deleted" event.
     */
    public function deleted(Screen $screen): void
    {
        //
    }

    /**
     * Handle the Screen "restored" event.
     */
    public function restored(Screen $screen): void
    {
        //
    }

    /**
     * Handle the Screen "force deleted" event.
     */
    public function forceDeleted(Screen $screen): void
    {
        //
    }
}
