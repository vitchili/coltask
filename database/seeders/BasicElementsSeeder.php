<?php 
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BasicElementsSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(1)->create();
        \App\Models\Product::factory(1)->create();
        \App\Models\Module::factory(1)->create();
        \App\Models\Screen::factory(1)->create();
        \App\Models\Fase::factory(1)->create();
        \App\Models\Direction::factory(1)->create();
        \App\Models\Project::factory(1)->create();
        \App\Models\Sprint::factory(1)->create();
        \App\Models\Kanban::factory(1)->create();
        \App\Models\Client::factory(1)->create();
        \App\Models\Priority::factory(1)->create();
        \App\Models\Task::factory(1)->create();

    }

}