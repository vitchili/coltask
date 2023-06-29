<?php

namespace App\Observers;

use App\Models\Module;

class ModuleObserver
{
    /**
     * Handle the Module "created" event.
     */
    public function created(Module $module): void
    {
        //
    }

    /**
     * Handle the Module "creating" event.
     */
    public function creating(Module $module): void
    {
        $module->created_at = now();
        $module->visibility = 1;
    }

    /**
     * Handle the Module "updated" event.
     */
    public function updated(Module $module): void
    {
        $module->updated_at = now();
    }

    /**
     * Handle the Module "deleted" event.
     */
    public function deleted(Module $module): void
    {
        //
    }

    /**
     * Handle the Module "restored" event.
     */
    public function restored(Module $module): void
    {
        //
    }

    /**
     * Handle the Module "force deleted" event.
     */
    public function forceDeleted(Module $module): void
    {
        //
    }
}
