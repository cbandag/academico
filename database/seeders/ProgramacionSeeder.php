<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ProgramacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::connection('pgsql')->table('programaciones')->truncate();
        DB::connection('pgsql')->table('programaciones')->insert([
            [
                'codigo_programa'=>'414',
                'programa'=>'ADMINISTRACION DE EMPRESAS DISTANCIA - CARTAGENA',
                'codigo_materia'=>'FB16216
                ',
                'materia'=>'HUMANIDADES',
                'grupo'=>'B1',                
                'semestre'=>'01',
                'tipo'=>'CC',
                'ide'=>'8834646',
                'nombres'=>'JERSON',
                'apellidos'=>'ESPITIA MERCADO',
                'npqprf'=>'Catedra',
                'semanas'=>'18',
                'horas'=>'1.25',
                'creditos'=>'2',
                'año'=>'2023',
                'periodo'=>'2'
            ],[
                
                'codigo_programa'=>'044',
                'programa'=>'ADMINISTRACION DE EMPRESAS DIURNA',
                'codigo_materia'=>'AH15101',
                'materia'=>'HUMANIDADES I',
                'grupo'=>'B1',                
                'semestre'=>'01',
                'tipo'=>'CC',
                'ide'=>'8834646',
                'nombres'=>'JERSON',
                'apellidos'=>'ESPITIA MERCADO',
                'npqprf'=>'Catedra',
                'semanas'=>'18',
                'horas'=>'3',
                'creditos'=>'2',
                'año'=>'2023',
                'periodo'=>'2'
            ],[
                'codigo_programa'=>'024',
                'programa'=>'ADMINISTRACION DE EMPRESAS NOCTURNA',
                'codigo_materia'=>'AH15101',
                'materia'=>'HUMANIDADES I',
                'grupo'=>'C1',                
                'semestre'=>'01',
                'tipo'=>'CC',
                'ide'=>'8834646',
                'nombres'=>'JERSON',
                'apellidos'=>'ESPITIA MERCADO',
                'npqprf'=>'Catedra',
                'semanas'=>'18',
                'horas'=>'3',
                'creditos'=>'2',
                'año'=>'2023',
                'periodo'=>'2'
            ],[
                'codigo_programa'=>'414',
                'programa'=>'ADMINISTRACION DE EMPRESAS DISTANCIA - CARTAGENA',
                'codigo_materia'=>'FB16219',
                'materia'=>'DERECHO CONSTITUCIONAL',
                'grupo'=>'B1',
                'semestre'=>'01',
                'tipo'=>'CC',
                'ide'=>'73144196',
                'nombres'=>'ESTEBAN ALBERTO',
                'apellidos'=>'JULIO AVILA',
                'npqprf'=>'Catedra',
                'semanas'=>'18',
                'horas'=>'1.25',
                'creditos'=>'2',
                'año'=>'2023',
                'periodo'=>'2'
            ],[
                'codigo_programa'=>'414',
                'programa'=>'ADMINISTRACION DE EMPRESAS DISTANCIA - CARTAGENA',
                'codigo_materia'=>'FB16212',
                'materia'=>'MATEMATICAS I',
                'grupo'=>'B1',
                'semestre'=>'01',
                'tipo'=>'CC',
                'ide'=>'73353464',
                'nombres'=>'JOSE DE LOS SANTOS',
                'apellidos'=>'MARRUGO PEREZ',
                'npqprf'=>'Catedra',
                'semanas'=>'18',
                'horas'=>'1.25',
                'creditos'=>'4',
                'año'=>'2023',
                'periodo'=>'2'
            ],[	
                'codigo_programa'=>'414',
                'programa'=>'ADMINISTRACION DE EMPRESAS DISTANCIA - CARTAGENA',
                'codigo_materia'=>'FB16219',
                'materia'=>'DERECHO CONSTITUCIONAL',
                'grupo'=>'C1',
                'semestre'=>'01',
                'tipo'=>'CC',
                'ide'=>'73144196',
                'nombres'=>'ESTEBAN ALBERTO',
                'apellidos'=>'JULIO AVILA',
                'npqprf'=>'Catedra',
                'semanas'=>'18',
                'horas'=>'1.25',
                'creditos'=>'2',
                'año'=>'2023',
                'periodo'=>'2'
            ],[
                'codigo_programa'=>'414',
                'programa'=>'ADMINISTRACION DE EMPRESAS DISTANCIA - CARTAGENA',
                'codigo_materia'=>'FB16215',
                'materia'=>'FUNDAMENTO DE ADMINISTRACION',
                'grupo'=>'B1',
                'semestre'=>'01',
                'tipo'=>'CC',
                'ide'=>'45475371',
                'nombres'=>'NELIA',
                'apellidos'=>'GARCIA FLOREZ',
                'npqprf'=>'Catedra',
                'semanas'=>'18',
                'horas'=>'1.25',
                'creditos'=>'3',
                'año'=>'2023',
                'periodo'=>'2'
            ]

        ]);

    }
}
