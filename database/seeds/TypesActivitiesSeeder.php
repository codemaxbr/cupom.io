<?php

use Illuminate\Database\Seeder;

class TypesActivitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\TypeActivity::create(['name' => 'Visualizar']);
        \App\Models\TypeActivity::create(['name' => 'Inserir']);
        \App\Models\TypeActivity::create(['name' => 'Alterar']);
        \App\Models\TypeActivity::create(['name' => 'Remover']);
        \App\Models\TypeActivity::create(['name' => 'Receber']);
        \App\Models\TypeActivity::create(['name' => 'Enviar']);
        \App\Models\TypeActivity::create(['name' => 'Imprimir']);
    }
}
