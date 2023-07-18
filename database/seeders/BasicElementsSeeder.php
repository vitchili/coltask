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
        $nameDirections = ['Administrativo', 'Análise de Qualidade', 'Desenvolvimento', 'Devops', 'Suporte'];
        $slangDirections = ['ADMIN', 'QA', 'DEV', 'DVPS', 'SUP'];

        for($i=0;$i<count($nameDirections); $i++){
            \App\Models\Direction::create([
                'name' => $nameDirections[$i],
                'slang' => $slangDirections[$i],
            ]);
        }
        \App\Models\User::first()->directions()->attach(\App\Models\Direction::where('slang', 'DEV')->first());

        \App\Models\Project::factory(1)->create();
        $nameFases = ['Em análise', 'Backlog', 'Em andamento', 'Em teste', 'Em refatoração', 'Aguardando publicação', 'Finalizado pelo Dev', 'Finalizado pelo Suporte', 'Cancelado', 'Aguardando feedback', 'Inativo outros motivos'];
        $descriptionsFases = ['Tarefa em análise para backlog', 'Tarefa na lista de pendências da sprint', 'Tarefa em desenvolvimento', 'Tarefa em teste pelo/a QA', 'Tarefa reprovada sendo refatorada', 'Tarefa aprovada aguardando deploy', 'Tarefa finalizada após todas etapas', 'Tarefa finalizada pelo Suporte', 'Tarefa cancelada', 'Aguardando retorno do cliente', 'Tarefa inativa por outros motivos'];

        for($i=0;$i<count($nameFases); $i++){
            \App\Models\Fase::create([
                'name' => $nameFases[$i],
                'description' => $descriptionsFases[$i],
            ]);
        }
        \App\Models\Sprint::factory(1)->create();
        \App\Models\Kanban::factory(1)->create();
        \App\Models\Client::factory(1)->create();
        \App\Models\Priority::factory(1)->create();
        \App\Models\Team::factory(1)->create();

        \App\Models\Task::factory(1)->create();

    }

}