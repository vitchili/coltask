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

        $client_id = 1;
        $email_copy = null;
        $outside_requester = "Vitor";
        $type = "E";
        $direction_id = 1;
        $title = "Teste de task Teste de task ";
        $description = "Teste desc Teste desc Teste desc Teste desc ";
        $screen_id = 1;
        $priority_id = 1;
        $dead_line = "2023-05-31 00:00:00";
        $attachment_json = null;
        $sprint_id = 1;

        for($i=0;$i<10; $i++){
            \App\Models\Task::create([
                'client_id' => $client_id, 
                'email_copy' => $email_copy, 
                'outside_requester' => $outside_requester, 
                'type' => $type, 
                'direction_id' => $direction_id, 
                'title' => $title . ' ' . $i, 
                'description' => $description . ' ' . $i, 
                'screen_id' => $screen_id, 
                'priority_id' => $priority_id, 
                'dead_line' => $dead_line, 
                'attachment_json' => $attachment_json, 
                'sprint_id' => $sprint_id, 
            ]);
        }
        

    }

}