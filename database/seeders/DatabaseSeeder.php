<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->truncateTables(['users']);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(FacultadSeeder::class);
        $this->call(ProgramaSeeder::class);
        $this->call(ActividadSeeder::class);
        $this->call(ProgramacionSeeder::class);
        $this->call(FuncionSeeder::class);


        // \App\Models\User::factory(10)->create();
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }

    protected function truncateTables(array $tables){
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        foreach ($tables as $key => $table) {
            DB::table($table)->truncate();
        }
    }
}
