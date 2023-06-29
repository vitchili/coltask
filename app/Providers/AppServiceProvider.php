<?php

namespace App\Providers;

use App\Models\Client;
use App\Models\Comment;
use App\Models\Direction;
use App\Models\Fase;
use App\Models\Kanban;
use App\Models\Module;
use App\Models\Priority;
use App\Models\Product;
use App\Models\Screen;
use App\Models\Sprint;
use App\Models\Task;
use App\Observers\ClientObserver;
use App\Observers\CommentObserver;
use App\Observers\DirectionObserver;
use App\Observers\FaseObserver;
use App\Observers\KanbanObserver;
use App\Observers\ModuleObserver;
use App\Observers\PriorityObserver;
use App\Observers\ProductObserver;
use App\Observers\ScreenObserver;
use App\Observers\SprintObserver;
use App\Observers\TaskObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Client::observe(ClientObserver::class);
        Comment::observe(CommentObserver::class);
        Direction::observe(DirectionObserver::class);
        Fase::observe(FaseObserver::class);
        Kanban::observe(KanbanObserver::class);
        Module::observe(ModuleObserver::class);
        Priority::observe(PriorityObserver::class);
        Product::observe(ProductObserver::class);
        Screen::observe(ScreenObserver::class);
        Sprint::observe(SprintObserver::class);
        Task::observe(TaskObserver::class);
    }
}
