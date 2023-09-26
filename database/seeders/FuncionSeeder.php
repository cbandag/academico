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
            'funcion' => 'Rector',
            'porcentaje_descarga' => '100'
        ],[
            'funcion' => 'Vicerrector',
            'porcentaje_descarga' => '100'
        ],[
            'funcion' => 'Secretario general',
            'porcentaje_descarga' => '100'
        ],[
            'funcion' => 'Coordinador académico general',
            'porcentaje_descarga' => '100'
        ],[
            'funcion' => 'Jefe de centro',
            'porcentaje_descarga' => '100'
        ],[
            'funcion' => 'Jefe de División',
            'porcentaje_descarga' => '100'
        ],[
            'funcion' => 'Jefe de oficina asesora',
            'porcentaje_descarga' => '100'
        ],[
            'funcion' => 'Decano',
            'porcentaje_descarga' => '100'
        ],[
            'funcion' => 'Director administrativo',
            'porcentaje_descarga' => '100'
        ],[
            'funcion' => 'Vice-decano',
            'porcentaje_descarga' => '75'
        ],[
            'funcion' => 'Jefe de departamento de postgrado',
            'porcentaje_descarga' => '75'
        ],[
            'funcion' => 'Director de instituto',
            'porcentaje_descarga' => '75'
        ],[
            'funcion' => 'Jefe de departamento',
            'porcentaje_descarga' => '50'
        ],[
            'funcion' => 'Director de programa',
            'porcentaje_descarga' => '50'
        ],[
            'funcion' => 'Coordinador de postgrado',
            'porcentaje_descarga' => '50'
        ],[
            'funcion' => 'Jefe de sección',
            'porcentaje_descarga' => '25'
        ],[
            'funcion' => 'Representante a consejo superior',
            'porcentaje_descarga' => '25'
        ],[
            'funcion' => 'Representante a consejo académico',
            'porcentaje_descarga' => '25'
        ],[
            'funcion' => 'Representante a consejo de facultad',
            'porcentaje_descarga' => '25'
        ],[
            'funcion' => 'Miembro de comité de la universidad',
            'porcentaje_descarga' => '10'
        ],[
            'funcion' => 'Miembro de comité de la facultad',
            'porcentaje_descarga' => '10'
        ],[
            'funcion' => 'Coordinador de programa',
            'porcentaje_descarga' => '10'
        ],[
            'funcion' => 'Coordinador de asignatura',
            'porcentaje_descarga' => '10'
        ],[
            'funcion' => 'Coordinador de área de pregrado',
            'porcentaje_descarga' => '10'
        ],[
            'funcion' => 'Presidente Agremiación docente',
            'porcentaje_descarga' => '30'
        ],[
            'funcion' => 'Miembro J.D. Agremiación docente',
            'porcentaje_descarga' => '15'
        ],[
            'funcion' => 'Jefe departamento Academico de facultad',
            'porcentaje_descarga' => '75'
        ]);

    }
}
