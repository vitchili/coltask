<?php

namespace App\Observers;

use App\Models\Fase;
use App\Models\Task;

class TaskObserver
{
    /**
     * Handle the Task "created" event.
     */
    public function created(Task $task): void
    {
        //
    }

    /**
     * Handle the Task "creating" event.
     */
    public function creating(Task $task): void
    {
        $task->created_by = 1; //auth()->user()->id; Reativar quando fizer a logica de auth toda
        $task->fase_id = 1;
        $task->created_at = now();
        $task->deployed = 0;
        $task->canceled = 0;
        $task->visibility = 1;
    }

    /**
     * Handle the Task "updated" event.
     */
    public function updated(Task $task): void
    {
        $task->updated_at = now();
    }

    /**
     * Handle the Task "deleted" event.
     */
    public function deleted(Task $task): void
    {
        //
    }

    /**
     * Handle the Task "restored" event.
     */
    public function restored(Task $task): void
    {
        //
    }

    /**
     * Handle the Task "force deleted" event.
     */
    public function forceDeleted(Task $task): void
    {
        //
    }
}
