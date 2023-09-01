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
        $admin = Role::create(['name'=>'Admin']);
        $planeacion = Role::create(['name'=>'Planeación']);
        $coordinaciónA = Role::create(['name'=>'CoordinacionA']);
        $jefe =  Role::create(['name'=>'Jefe']);
        $docente =  Role::create(['name'=>'Docente']);

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
        
        $permission1 = Permission::create(['name' => 'planes.index'])->syncRoles([$admin,$planeacion]);
        $permission1 = Permission::create(['name' => 'planes.create'])->syncRoles([$admin,$planeacion]);
        $permission1 = Permission::create(['name' => 'planes.edit'])->syncRoles([$admin,$planeacion, $docente]);
        $permission1 = Permission::create(['name' => 'planes.update'])->syncRoles([$admin,$planeacion, $docente]);
        $permission1 = Permission::create(['name' => 'planes.show'])->syncRoles([$admin,$planeacion, $docente]);
        $permission1 = Permission::create(['name' => 'planes.destroy'])->syncRoles([$admin,$planeacion]);
    }
}
