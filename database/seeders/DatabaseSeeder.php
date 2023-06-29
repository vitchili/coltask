<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(BasicElementsSeeder::class); //Apenas em teste. Destrua em produção.
        $this->call(PermissionsSeeder::class); //Cria permissoes (Está dando role pro usuario fake criado. Apagar o trecho que faz isso aqui dentro.)
    }
}
