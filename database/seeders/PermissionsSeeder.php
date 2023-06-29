<?php 
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    /**
     * Create the initial roles and permissions.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'ver tela de chamados']);
        Permission::create(['name' => 'ver graficos']);
        Permission::create(['name' => 'ver proprio kanban ']);
        Permission::create(['name' => 'ver kanban de todos']);
        Permission::create(['name' => 'criar chamado']);
        Permission::create(['name' => 'ver tela de chamado']);
        Permission::create(['name' => 'editar chamado']);
        Permission::create(['name' => 'criar mensagem interna']);
        Permission::create(['name' => 'criar mensagem externa']);
        Permission::create(['name' => 'criar email']);
        Permission::create(['name' => 'criar switch-case']);
        Permission::create(['name' => 'criar modificacao']);
        Permission::create(['name' => 'ver tela de testes']);
        Permission::create(['name' => 'criar teste']);
        Permission::create(['name' => 'ver histórico de testes']);
        Permission::create(['name' => 'ver gráficos de testes']);
        Permission::create(['name' => 'ver historico dos chamados']);
        Permission::create(['name' => 'ver lista de sprints']);
        Permission::create(['name' => 'ver sprints']);
        Permission::create(['name' => 'editar sprints']);
        Permission::create(['name' => 'excluir sprints']);
        Permission::create(['name' => 'criar sprints']);
        Permission::create(['name' => 'ver todos diarios']);
        Permission::create(['name' => 'ver proprio diario']);

        //Super-admin
        $roleSuperAdmin = Role::create(['name' => 'Super-Admin']);
        
        //Admin
        $roleAdmin = Role::create(['name' => 'admin']);
        $roleAdmin->givePermissionTo('ver tela de chamados');
        $roleAdmin->givePermissionTo('ver graficos');
        $roleAdmin->givePermissionTo('ver kanban de todos');
        $roleAdmin->givePermissionTo('criar chamado');
        $roleAdmin->givePermissionTo('ver tela de chamado');
        $roleAdmin->givePermissionTo('editar chamado');
        $roleAdmin->givePermissionTo('criar mensagem interna');
        $roleAdmin->givePermissionTo('criar mensagem externa');
        $roleAdmin->givePermissionTo('criar email');
        $roleAdmin->givePermissionTo('ver tela de testes');
        $roleAdmin->givePermissionTo('ver histórico de testes');
        $roleAdmin->givePermissionTo('ver gráficos de testes');
        $roleAdmin->givePermissionTo('ver historico dos chamados');
        $roleAdmin->givePermissionTo('ver lista de sprints');
        $roleAdmin->givePermissionTo('ver sprints');
        $roleAdmin->givePermissionTo('editar sprints');
        $roleAdmin->givePermissionTo('excluir sprints');
        $roleAdmin->givePermissionTo('criar sprints');
        $roleAdmin->givePermissionTo('ver todos diarios');

        //Desenvolvedor
        $roleDesenvolvedor = Role::create(['name' => 'desenvolvedor']);
        $roleDesenvolvedor->givePermissionTo('ver tela de chamados');
        $roleDesenvolvedor->givePermissionTo('ver graficos');
        $roleDesenvolvedor->givePermissionTo('ver proprio kanban ');
        $roleDesenvolvedor->givePermissionTo('criar chamado');
        $roleDesenvolvedor->givePermissionTo('editar chamado');
        $roleDesenvolvedor->givePermissionTo('criar mensagem interna');
        $roleDesenvolvedor->givePermissionTo('criar mensagem externa');
        $roleDesenvolvedor->givePermissionTo('criar email');
        $roleDesenvolvedor->givePermissionTo('criar switch-case');
        $roleDesenvolvedor->givePermissionTo('criar modificacao');
        $roleDesenvolvedor->givePermissionTo('ver historico dos chamados');
        $roleDesenvolvedor->givePermissionTo('ver lista de sprints');
        $roleDesenvolvedor->givePermissionTo('ver sprints');
        $roleDesenvolvedor->givePermissionTo('ver proprio diario');
        
        //Tester
        $roleTester = Role::create(['name' => 'tester']);
        $roleTester->givePermissionTo('ver tela de chamados');
        $roleTester->givePermissionTo('ver graficos');
        $roleTester->givePermissionTo('ver proprio kanban ');
        $roleTester->givePermissionTo('criar chamado');
        $roleTester->givePermissionTo('ver tela de testes');
        $roleTester->givePermissionTo('criar teste');
        $roleTester->givePermissionTo('ver histórico de testes');
        $roleTester->givePermissionTo('ver gráficos de testes');
        $roleTester->givePermissionTo('ver proprio diario');
        
        //Suporte
        $roleSuporte = Role::create(['name' => 'suporte']);
        $roleSuporte->givePermissionTo('ver tela de chamados');
        $roleSuporte->givePermissionTo('ver graficos');
        $roleSuporte->givePermissionTo('ver proprio kanban ');
        $roleSuporte->givePermissionTo('criar chamado');
        $roleSuporte->givePermissionTo('ver tela de chamado');
        $roleSuporte->givePermissionTo('editar chamado');
        $roleSuporte->givePermissionTo('criar mensagem interna');
        $roleSuporte->givePermissionTo('criar mensagem externa');
        $roleSuporte->givePermissionTo('criar email');
        $roleSuporte->givePermissionTo('ver tela de testes');
        $roleSuporte->givePermissionTo('ver histórico de testes');
        $roleSuporte->givePermissionTo('ver gráficos de testes');
        $roleSuporte->givePermissionTo('ver historico dos chamados');
        $roleSuporte->givePermissionTo('ver proprio diario');


        $roleBI = Role::create(['name' => 'businessInteligente']);
        $roleBI->givePermissionTo('ver tela de chamados');
        $roleBI->givePermissionTo('ver graficos');
        $roleBI->givePermissionTo('ver histórico de testes');
        $roleBI->givePermissionTo('ver gráficos de testes');
        $roleBI->givePermissionTo('ver historico dos chamados');
        $roleBI->givePermissionTo('ver tela de testes');
        $roleBI->givePermissionTo('ver proprio diario');

        //Assign role to first user
        $user = User::first();
        $user->assignRole($roleAdmin);

    }
}