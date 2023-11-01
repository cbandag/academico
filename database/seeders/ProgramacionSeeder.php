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
                'programa'=>'ADMINISTRACION DE EMPRESAS DIURNA',
                'codigo_materia'=>'AF16243',
                'materia'=>'MATEMATICAS FINANCIERAS',
                'grupo'=>'B1',
                'tipo'=>'CC',
                'ide'=>'33156597',
                'nombres'=>'ADALGIZA',
                'apellidos'=>'MARQUEZ POLO',
                'npqprf'=>'Planta',
                'horas'=>'1',
                'año'=>'2022',
                'periodo'=>'1'
            ],[

                'codigo_programa'=>'414',
                'programa'=>'ADMINISTRACION DE EMPRESAS DIURNA',
                'codigo_materia'=>'AF16243',
                'materia'=>'MATEMATICAS FINANCIERAS',
                'grupo'=>'C1',
                'tipo'=>'CC',
                'ide'=>'33156597',
                'nombres'=>'ADALGIZA ',
                'apellidos'=>'MARQUEZ POLO',
                'npqprf'=>'Planta',
                'horas'=>'2',
                'año'=>'2022',
                'periodo'=>'1'
            ],[

                'codigo_programa'=>'205',
                'programa'=>'ADMINISTRACION FINANCIERA - CARTAGENA',
                'codigo_materia'=>'FB16241',
                'materia'=>'MATEMATICA FINANCIERA',
                'grupo'=>'B1',
                'tipo'=>'CC',
                'ide'=>'33156597',
                'nombres'=>'ADALGIZA ',
                'apellidos'=>'MARQUEZ POLO',
                'npqprf'=>'Planta',
                'horas'=>'5',
                'año'=>'2022',
                'periodo'=>'1'
            ]


            ,[

                'codigo_programa'=>'414',
                'programa'=>'ADMINISTRACION DE EMPRESAS DISTANCIA - CARTAGENA',
                'codigo_materia'=>'AF16266',
                'materia'=>'INICIATIVA EMPRESARIAL ',
                'grupo'=>'B1',
                'tipo'=>'CC',
                'ide'=>'73167380',
                'nombres'=>'DIEGO ALONSO',
                'apellidos'=>'CARDONA ARBELAEZ',
                'npqprf'=>'Planta',
                'horas'=>'1',
                'año'=>'2023',
                'periodo'=>'1'
            ],[

                'codigo_programa'=>'414',
                'programa'=>'ADMINISTRACION DE EMPRESAS DISTANCIA - CARTAGENA',
                'codigo_materia'=>'AF16266',
                'materia'=>'INICIATIVA EMPRESARIAL ',
                'grupo'=>'C1',
                'tipo'=>'CC',
                'ide'=>'73167380',
                'nombres'=>'DIEGO ALONSO',
                'apellidos'=>'CARDONA ARBELAEZ',
                'npqprf'=>'Planta',
                'horas'=>'1',
                'año'=>'2022',
                'periodo'=>'2'
            ],

        ]);

    }
}
