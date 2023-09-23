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
        $jefe =  Role::create(['name'=>'jefe']);
        $decano =  Role::create(['name'=>'decano']);
        $docente =  Role::create(['name'=>'docente']);
        $planeacion = Role::create(['name'=>'planeación']);
        $coordinaciónA = Role::create(['name'=>'coordinacion']);
        

        $permission1 = Permission::create(['name' => 'jefes.index'])->syncRoles([$admin,$planeacion]);
        $permission1 = Permission::create(['name' => 'jefes.create'])->syncRoles([$admin,$planeacion]);
        $permission1 = Permission::create(['name' => 'jefes.edit'])->syncRoles([$admin,$planeacion]);
        $permission1 = Permission::create(['name' => 'jefes.update'])->syncRoles([$admin,$planeacion]);
        $permission1 = Permission::create(['name' => 'jefes.show'])->syncRoles([$admin,$planeacion]);
        $permission1 = Permission::create(['name' => 'jefes.destroy'])->syncRoles([$admin,$planeacion]);

        $permission1 = Permission::create(['name' => 'decanos.index'])->syncRoles([$admin,$planeacion,]);
        $permission1 = Permission::create(['name' => 'decanos.create'])->syncRoles([$admin,$planeacion,]);
        $permission1 = Permission::create(['name' => 'decanos.edit'])->syncRoles([$admin,$planeacion,]);
        $permission1 = Permission::create(['name' => 'decanos.update'])->syncRoles([$admin,$planeacion,]);
        $permission1 = Permission::create(['name' => 'decanos.show'])->syncRoles([$admin,$planeacion,]);
        $permission1 = Permission::create(['name' => 'decanos.destroy'])->syncRoles([$admin,$planeacion,]);

        $permission1 = Permission::create(['name' => 'docentes.index'])->syncRoles([$admin, $planeacion, $decano, $jefe]);
        $permission1 = Permission::create(['name' => 'docentes.create'])->syncRoles([$admin, $planeacion, $decano, $jefe]);
        $permission1 = Permission::create(['name' => 'docentes.edit'])->syncRoles([$admin,$planeacion, $decano, $jefe]);
        $permission1 = Permission::create(['name' => 'docentes.update'])->syncRoles([$admin,$planeacion, $decano, $jefe]);
        $permission1 = Permission::create(['name' => 'docentes.show'])->syncRoles([$admin,$planeacion, $decano, $jefe]);
        $permission1 = Permission::create(['name' => 'docentes.destroy'])->syncRoles([$admin,$planeacion, $decano, $jefe]);

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

        $permission1 = Permission::create(['name' => 'programacion.index'])->syncRoles([$admin,$planeacion]);
        $permission1 = Permission::create(['name' => 'programacion.create'])->syncRoles([$admin,$planeacion]);
        $permission1 = Permission::create(['name' => 'programacion.edit'])->syncRoles([$admin,$planeacion]);
        $permission1 = Permission::create(['name' => 'programacion.update'])->syncRoles([$admin,$planeacion]);
        $permission1 = Permission::create(['name' => 'programacion.show'])->syncRoles([$admin,$planeacion]);
        $permission1 = Permission::create(['name' => 'programacion.destroy'])->syncRoles([$admin,$planeacion]);

        $permission1 = Permission::create(['name' => 'programas.index'])->syncRoles([$admin,$planeacion]);
        $permission1 = Permission::create(['name' => 'programas.create'])->syncRoles([$admin,$planeacion]);
        $permission1 = Permission::create(['name' => 'programas.edit'])->syncRoles([$admin,$planeacion]);
        $permission1 = Permission::create(['name' => 'programas.update'])->syncRoles([$admin,$planeacion]);
        $permission1 = Permission::create(['name' => 'programas.show'])->syncRoles([$admin,$planeacion]);
        $permission1 = Permission::create(['name' => 'programas.destroy'])->syncRoles([$admin,$planeacion]);
        
        $permission1 = Permission::create(['name' => 'actividades.index'])->syncRoles([$admin, $planeacion, $jefe, $decano, $docente]);
        $permission1 = Permission::create(['name' => 'actividades.create'])->syncRoles([$admin, $planeacion, $jefe, $decano, $docente]);
        $permission1 = Permission::create(['name' => 'actividades.edit'])->syncRoles([$admin, $planeacion, $jefe, $decano, $docente]);
        $permission1 = Permission::create(['name' => 'actividades.update'])->syncRoles([$admin, $planeacion, $jefe, $decano, $docente]);
        $permission1 = Permission::create(['name' => 'actividades.show'])->syncRoles([$admin, $planeacion, $jefe, $decano, $docente]);
        $permission1 = Permission::create(['name' => 'actividades.destroy'])->syncRoles([$admin, $planeacion, $jefe, $decano, $docente]);

        $permission1 = Permission::create(['name' => 'asignaciones.index'])->syncRoles([$admin, $planeacion]);
        $permission1 = Permission::create(['name' => 'asignaciones.create'])->syncRoles([$admin, $planeacion]);
        $permission1 = Permission::create(['name' => 'asignaciones.edit'])->syncRoles([$admin, $planeacion]);
        $permission1 = Permission::create(['name' => 'asignaciones.update'])->syncRoles([$admin, $planeacion]);
        $permission1 = Permission::create(['name' => 'asignaciones.show'])->syncRoles([$admin, $planeacion]);
        $permission1 = Permission::create(['name' => 'asignaciones.destroy'])->syncRoles([$admin, $planeacion]);
        
        $permission1 = Permission::create(['name' => 'programaciones.index'])->syncRoles([$admin, $planeacion]);
        $permission1 = Permission::create(['name' => 'programaciones.create'])->syncRoles([$admin, $planeacion]);
        $permission1 = Permission::create(['name' => 'programaciones.edit'])->syncRoles([$admin, $planeacion]);
        $permission1 = Permission::create(['name' => 'programaciones.update'])->syncRoles([$admin, $planeacion]);
        $permission1 = Permission::create(['name' => 'programaciones.show'])->syncRoles([$admin, $planeacion]);
        $permission1 = Permission::create(['name' => 'programaciones.destroy'])->syncRoles([$admin, $planeacion]);


    }
}
