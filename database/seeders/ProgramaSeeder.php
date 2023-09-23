<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgramaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('programas')->insert([
            'nombre' => 'Ingenieria de Sistemas',
            'facultad_id' => '1'
        ]);
        DB::table('programas')->insert([
            'nombre' => 'Medicina',
            'facultad_id' => '2'
        ]);
    }
}
