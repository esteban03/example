<?php

use Illuminate\Database\Seeder;
use App\Rol;

class RolsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rol::create([
            'name' => 'admin',
            'display_name' => 'Administrador'
        ]);
        Rol::create([
            'name' => 'jefatura',
            'display_name' => 'Jefatura'
        ]);
        Rol::create([
            'name' => 'analista',
            'display_name' => 'Analista'
        ]);
        Rol::create([
            'name' => 'programador',
            'display_name' => 'Programador'
        ]);
    }
}
