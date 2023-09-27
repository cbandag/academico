<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FuncionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('funciones')->insert([
        [
            'funcion' => 'Rector',
            'descarga' => '100'
        ],[
            'funcion' => 'Vicerrector',
            'descarga' => '100'
        ],[
            'funcion' => 'Secretario general',
            'descarga' => '100'
        ],[
            'funcion' => 'Coordinador académico general',
            'descarga' => '100'
        ],[
            'funcion' => 'Jefe de centro',
            'descarga' => '100'
        ],[
            'funcion' => 'Jefe de División',
            'descarga' => '100'
        ],[
            'funcion' => 'Jefe de oficina asesora',
            'descarga' => '100'
        ],[
            'funcion' => 'Decano',
            'descarga' => '100'
        ],[
            'funcion' => 'Director administrativo',
            'descarga' => '100'
        ],[
            'funcion' => 'Vice-decano',
            'descarga' => '75'
        ],[
            'funcion' => 'Jefe de departamento de postgrado',
            'descarga' => '75'
        ],[
            'funcion' => 'Director de instituto',
            'descarga' => '75'
        ],[
            'funcion' => 'Jefe de departamento',
            'descarga' => '50'
        ],[
            'funcion' => 'Director de programa',
            'descarga' => '50'
        ],[
            'funcion' => 'Coordinador de postgrado',
            'descarga' => '50'
        ],[
            'funcion' => 'Jefe de sección',
            'descarga' => '25'
        ],[
            'funcion' => 'Representante a consejo superior',
            'descarga' => '25'
        ],[
            'funcion' => 'Representante a consejo académico',
            'descarga' => '25'
        ],[
            'funcion' => 'Representante a consejo de facultad',
            'descarga' => '25'
        ],[
            'funcion' => 'Miembro de comité de la universidad',
            'descarga' => '10'
        ],[
            'funcion' => 'Miembro de comité de la facultad',
            'descarga' => '10'
        ],[
            'funcion' => 'Coordinador de programa',
            'descarga' => '10'
        ],[
            'funcion' => 'Coordinador de asignatura',
            'descarga' => '10'
        ],[
            'funcion' => 'Coordinador de área de pregrado',
            'descarga' => '10'
        ],[
            'funcion' => 'Presidente Agremiación docente',
            'descarga' => '30'
        ],[
            'funcion' => 'Miembro J.D. Agremiación docente',
            'descarga' => '15'
        ],[
            'funcion' => 'Jefe departamento Academico de facultad',
            'descarga' => '75'
        ]]);

    }
}
