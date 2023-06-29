<?php

namespace App\Observers;

use App\Models\Direction;

class DirectionObserver
{
    /**
     * Handle the Direction "created" event.
     */
    public function created(Direction $direction): void
    {
        //
    }

    /**
     * Handle the Direction "creating" event.
     */
    public function creating(Direction $direction): void
    {
        $direction->created_at = now();
        $direction->visibility = 1;
    }

    /**
     * Handle the Direction "updated" event.
     */
    public function updated(Direction $direction): void
    {
        $direction->updated_at = now();
    }

    /**
     * Handle the Direction "deleted" event.
     */
    public function deleted(Direction $direction): void
    {
        //
    }

    /**
     * Handle the Direction "restored" event.
     */
    public function restored(Direction $direction): void
    {
        //
    }

    /**
     * Handle the Direction "force deleted" event.
     */
    public function forceDeleted(Direction $direction): void
    {
        //
    }
}
