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
            'estado' => 'Activo',
            'email' => '28bandag@gmail.com',
            'password'=> '12345678'
            
        ])->assignRole('admin');

        User::Create([
            'nombres' => 'Sixto',
            'apellidos' => 'Figueroa',
            'identificacion' => '123456789',
            'estado' => 'Activo',
            'email' => 'sixmafire@gmail.com',
            'password'=> '123456789'
            
        ])->assignRole('admin');
        /*
        DB::table('users')->insert([
            'nombres' => 'Carlos',
            'apellidos' => 'Banda',
            'identificacion' => '12345678',
            'estado' => 'Activo',
            'email' => '28bandag@gmail.com',
            'password'=> Hash::make('12345678')
            
        ]);


        DB::table('users')->insert([
            'nombres' => Str::random(10),
            'apellidos' => Str::random(10),
            'identificacion' =>random_int(1000000, 9999999),
            'estado' => 'Activo',
            'email' => Str::random(10).'@gmail.com',
            'password'=> Hash::make('password')
        ]);
        */
    }
}
