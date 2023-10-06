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
            'descarga' => '1'
        ],[
            'funcion' => 'Vicerrector',
            'descarga' => '1'
        ],[
            'funcion' => 'Secretario general',
            'descarga' => '1'
        ],[
            'funcion' => 'Coordinador académico general',
            'descarga' => '1'
        ],[
            'funcion' => 'Jefe de centro',
            'descarga' => '1'
        ],[
            'funcion' => 'Jefe de División',
            'descarga' => '1'
        ],[
            'funcion' => 'Jefe de oficina asesora',
            'descarga' => '1'
        ],[
            'funcion' => 'Decano',
            'descarga' => '1'
        ],[
            'funcion' => 'Director administrativo',
            'descarga' => '1'
        ],[
            'funcion' => 'Vice-decano',
            'descarga' => '0.75'
        ],[
            'funcion' => 'Jefe de departamento de postgrado',
            'descarga' => '0.75'
        ],[
            'funcion' => 'Director de instituto',
            'descarga' => '0.75'
        ],[
            'funcion' => 'Jefe de departamento',
            'descarga' => '0.50'
        ],[
            'funcion' => 'Director de programa de pregrado',
            'descarga' => '0.75'
        ],[
            'funcion' => 'Coordinador de programa de postgrado',
            'descarga' => '0.50'
        ],[
            'funcion' => 'Jefe de sección',
            'descarga' => '0.25'
        ],[
            'funcion' => 'Representante a consejo superior',
            'descarga' => '0.3'
        ],[
            'funcion' => 'Representante a consejo académico',
            'descarga' => '0.3'
        ],[
            'funcion' => 'Representante a consejo de facultad',
            'descarga' => '0.3'
        ],[
            'funcion' => 'Miembro de comité de la universidad',
            'descarga' => '0.10'
        ],[
            'funcion' => 'Miembro de comité de la facultad',
            'descarga' => '0.10'
        ],[
            'funcion' => 'Coordinador de programa',
            'descarga' => '0.10'
        ],[
            'funcion' => 'Coordinador de asignatura',
            'descarga' => '0.10'
        ],[
            'funcion' => 'Coordinador de área de pregrado',
            'descarga' => '0.10'
        ],[
            'funcion' => 'Presidente Agremiación docente',
            'descarga' => '0.30'
        ],[
            'funcion' => 'Miembro J.D. Agremiación docente',
            'descarga' => '0.15'
        ],[
            'funcion' => 'Jefe departamento Academico de facultad',
            'descarga' => '0.75'
        ]]);

    }
}
