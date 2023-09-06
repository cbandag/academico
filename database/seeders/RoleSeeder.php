<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::create(['name'=>'admin']);
        $planeacion = Role::create(['name'=>'planeación']);
        $coordinaciónA = Role::create(['name'=>'coordinacion']);
        $jefe =  Role::create(['name'=>'jefe']);
        $docente =  Role::create(['name'=>'docente']);

        $permission1 = Permission::create(['name' => 'periodos.index'])->syncRoles([$admin,$planeacion]);
        $permission1 = Permission::create(['name' => 'periodos.create'])->syncRoles([$admin,$planeacion]);
        $permission1 = Permission::create(['name' => 'periodos.edit'])->syncRoles([$admin,$planeacion]);
        $permission1 = Permission::create(['name' => 'periodos.update'])->syncRoles([$admin,$planeacion]);
        $permission1 = Permission::create(['name' => 'periodos.show'])->syncRoles([$admin,$planeacion]);
        $permission1 = Permission::create(['name' => 'periodos.destroy'])->syncRoles([$admin,$planeacion]);

        $permission1 = Permission::create(['name' => 'facultades.index'])->syncRoles([$admin,$planeacion]);
        $permission1 = Permission::create(['name' => 'facultades.create'])->syncRoles([$admin,$planeacion]);
        $permission1 = Permission::create(['name' => 'facultades.edit'])->syncRoles([$admin,$planeacion]);
        $permission1 = Permission::create(['name' => 'facultades.update'])->syncRoles([$admin,$planeacion]);
        $permission1 = Permission::create(['name' => 'facultades.show'])->syncRoles([$admin,$planeacion]);
        $permission1 = Permission::create(['name' => 'facultades.destroy'])->syncRoles([$admin,$planeacion]);

        $permission1 = Permission::create(['name' => 'programas.index'])->syncRoles([$admin,$planeacion]);
        $permission1 = Permission::create(['name' => 'programas.create'])->syncRoles([$admin,$planeacion]);
        $permission1 = Permission::create(['name' => 'programas.edit'])->syncRoles([$admin,$planeacion]);
        $permission1 = Permission::create(['name' => 'programas.update'])->syncRoles([$admin,$planeacion]);
        $permission1 = Permission::create(['name' => 'programas.show'])->syncRoles([$admin,$planeacion]);
        $permission1 = Permission::create(['name' => 'programas.destroy'])->syncRoles([$admin,$planeacion]);
        
        $permission1 = Permission::create(['name' => 'actividades.index'])->syncRoles([$admin,$planeacion]);
        $permission1 = Permission::create(['name' => 'actividades.create'])->syncRoles([$admin,$planeacion]);
        $permission1 = Permission::create(['name' => 'actividades.edit'])->syncRoles([$admin,$planeacion, $docente]);
        $permission1 = Permission::create(['name' => 'actividades.update'])->syncRoles([$admin,$planeacion, $docente]);
        $permission1 = Permission::create(['name' => 'actividades.show'])->syncRoles([$admin,$planeacion, $docente]);
        $permission1 = Permission::create(['name' => 'actividades.destroy'])->syncRoles([$admin,$planeacion]);
    }
}
