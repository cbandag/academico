<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

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

        User::Create([
            'nombres' => 'Sixto',
            'apellidos' => 'Figueroa',
            'identificacion' => '123456789',
            'estado' => 'ACTIVO',
            'email' => 'sixmafire@gmail.com',
            'password'=> '12345678'
            
        ])->assignRole('admin');

        User::Create([
            'nombres' => 'planeación',
            'apellidos' => 'planeacioncillo',
            'identificacion' => '111111',
            'estado' => 'ACTIVO',
            'email' => 'planeacion@gmail.com',
            'password'=> '12345678'
            
        ])->assignRole('planeación');

        User::Create([
            'nombres' => 'jefe',
            'apellidos' => 'jefecito',
            'identificacion' => '222222',
            'estado' => 'ACTIVO',
            'email' => 'jefe@gmail.com',
            'password'=> '12345678'
            
        ])->assignRole('jefe');

        User::Create([
            'nombres' => 'Docente',
            'apellidos' => 'Docentico',
            'identificacion' => '333333',
            'estado' => 'ACTIVO',
            'email' => 'docente@gmail.com',
            'password'=> '12345678'
            
        ])->assignRole('docente');

        /*
        DB::table('users')->insert([
            'nombres' => 'Carlos',
            'apellidos' => 'Banda',
            'identificacion' => '12345678',
            'estado' => 'ACTIVO',
            'email' => '28bandag@gmail.com',
            'password'=> Hash::make('12345678')
            
        ]);


        DB::table('users')->insert([
            'nombres' => Str::random(10),
            'apellidos' => Str::random(10),
            'identificacion' =>random_int(1000000, 9999999),
            'estado' => 'ACTIVO',
            'email' => Str::random(10).'@gmail.com',
            'password'=> Hash::make('password')
        ]);
        */
    }
}
