<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\JefesPorPeriodo;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::Create([
            'nombres' => 'Carlos',
            'apellidos' => 'Banda',
            'identificacion' => '12345678',
            'estado' => 'ACTIVO',
            'email' => '28bandag@gmail.com',
            'password'=> '12345678'

        ])->assignRole('admin');
        /*

        User::Create([
            'nombres' => 'Sixto',
            'apellidos' => 'Figueroa',
            'identificacion' => '123456789',
            'estado' => 'ACTIVO',
            'email' => 'sixmafire@gmail.com',
            'password'=> '12345678'

        ])->assignRole('admin');
        */

        User::Create([
            'nombres' => 'asignacion',
            'apellidos' => '1',
            'identificacion' => '11111111',
            'estado' => 'ACTIVO',
            'email' => 'asignacion@gmail.com',
            'password'=> '11111111'

        ])->assignRole('asignacion');


        User::Create([
            'nombres' => 'planeación',
            'apellidos' => '2',
            'identificacion' => '22222222',
            'estado' => 'ACTIVO',
            'email' => 'planeacion@gmail.com',
            'password'=> '22222222'

        ])->assignRole('planeación');

        User::Create([
            'nombres' => 'jefe',
            'apellidos' => '3',
            'identificacion' => '33333333',
            'estado' => 'ACTIVO',
            'email' => 'jefe3@gmail.com',
            'password'=> '33333333'

        ])->assignRole('jefe');

        User::Create([
            'nombres' => 'jefe',
            'apellidos' => '4',
            'identificacion' => '44444444',
            'estado' => 'ACTIVO',
            'email' => 'jefe4@gmail.com',
            'password'=> '44444444'

        ])->assignRole('jefe');


        JefesPorPeriodo::create([
            'identificacion_jefe' => '33333333',
            'identificacion_jefe_provisional' => '',
            'año' =>'2022',
            'periodo' =>'01',
        ]);

        JefesPorPeriodo::create([
            'identificacion_jefe' => '44444444',
            'identificacion_jefe_provisional' => '',
            'año' =>'2022',
            'periodo' =>'01',
        ]);

/*
        User::Create([
            'nombres' => 'docente',
            'apellidos' => '5',
            'identificacion' => '55555555',
            'estado' => 'ACTIVO',
            'email' => 'docente5@gmail.com',
            'password'=> '55555555'

        ])->assignRole('docente');


*/

    }
}
