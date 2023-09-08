<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FacultadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('facultades')->insert([
            'nombre' => 'Ingenieria'
        ]);
        DB::table('facultades')->insert([
            'nombre' => 'Medicina'
        ]);
    }
}
