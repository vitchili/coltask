<?php

namespace App\Observers;

use App\Models\Kanban;

class KanbanObserver
{
    /**
     * Handle the Kanban "created" event.
     */
    public function created(Kanban $kanban): void
    {
        //
    }

    /**
     * Handle the Kanban "creating" event.
     */
    public function creating(Kanban $kanban): void
    {
        $kanban->created_at = now();
    }

    /**
     * Handle the Kanban "updated" event.
     */
    public function updated(Kanban $kanban): void
    {
        $kanban->updated_at = now();
    }

    /**
     * Handle the Kanban "deleted" event.
     */
    public function deleted(Kanban $kanban): void
    {
        //
    }

    /**
     * Handle the Kanban "restored" event.
     */
    public function restored(Kanban $kanban): void
    {
        //
    }

    /**
     * Handle the Kanban "force deleted" event.
     */
    public function forceDeleted(Kanban $kanban): void
    {
        //
    }
}
