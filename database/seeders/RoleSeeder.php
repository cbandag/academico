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
        $asignacion = Role::create(['name'=>'asignación']);
        $coordinaciónA = Role::create(['name'=>'coordinacion']);


        /* Periodos */
        $permission1 = Permission::create(['name' => 'periodos.index'])->syncRoles([$admin,$planeacion,$asignacion]);
        $permission1 = Permission::create(['name' => 'periodos.create'])->syncRoles([$admin,$planeacion,$asignacion]);
        $permission1 = Permission::create(['name' => 'periodos.edit'])->syncRoles([$admin,$planeacion,$asignacion]);
        $permission1 = Permission::create(['name' => 'periodos.update'])->syncRoles([$admin,$planeacion,$asignacion]);
        $permission1 = Permission::create(['name' => 'periodos.show'])->syncRoles([$admin,$planeacion,$asignacion]);
        $permission1 = Permission::create(['name' => 'periodos.destroy'])->syncRoles([$admin,$planeacion,$asignacion]);


        /* Usuarios */
        $permission1 = Permission::create(['name' => 'usuarios.index'])->syncRoles([$admin,$planeacion,$asignacion]);
        $permission1 = Permission::create(['name' => 'usuarios.importjefes'])->syncRoles([$admin,$planeacion,$asignacion]);
        $permission1 = Permission::create(['name' => 'usuarios.exportjefes'])->syncRoles([$admin,$planeacion,$asignacion]);
        $permission1 = Permission::create(['name' => 'usuarios.createjefes'])->syncRoles([$admin,$planeacion,$asignacion]);
        $permission1 = Permission::create(['name' => 'usuarios.storejefes'])->syncRoles([$admin,$planeacion,$asignacion]);
        $permission1 = Permission::create(['name' => 'usuarios.editjefes'])->syncRoles([$admin,$planeacion,$asignacion]);
        $permission1 = Permission::create(['name' => 'usuarios.updatejefes'])->syncRoles([$admin,$planeacion,$asignacion]);
        $permission1 = Permission::create(['name' => 'usuarios.importdocentes'])->syncRoles([$admin,$planeacion,$asignacion]);
        $permission1 = Permission::create(['name' => 'usuarios.exportdocentes'])->syncRoles([$admin,$planeacion,$asignacion]);
        $permission1 = Permission::create(['name' => 'usuarios.createdocentes'])->syncRoles([$admin,$planeacion,$asignacion]);
        $permission1 = Permission::create(['name' => 'usuarios.storedocentes'])->syncRoles([$admin,$planeacion,$asignacion]);
        $permission1 = Permission::create(['name' => 'usuarios.editdocentes'])->syncRoles([$admin,$planeacion,$asignacion]);
        $permission1 = Permission::create(['name' => 'usuarios.updatedocentes'])->syncRoles([$admin,$planeacion,$asignacion]);
        $permission1 = Permission::create(['name' => 'usuarios.createjefesprovisionales'])->syncRoles([$admin,$planeacion,$asignacion]);
        $permission1 = Permission::create(['name' => 'usuarios.docentesporjefe'])->syncRoles([$admin,$planeacion,$asignacion]);
        $permission1 = Permission::create(['name' => 'usuarios.reset_password'])->syncRoles([$admin,$planeacion,$asignacion]);


        /* Asignaciones */
        $permission1 = Permission::create(['name' => 'asignaciones.index'])->syncRoles([$admin, $planeacion, $asignacion, $jefe]);
        $permission1 = Permission::create(['name' => 'asignaciones.show'])->syncRoles([$admin, $planeacion, $asignacion, $jefe]);
        $permission1 = Permission::create(['name' => 'asignaciones.edit'])->syncRoles([$admin, $jefe]);
        $permission1 = Permission::create(['name' => 'asignaciones.update'])->syncRoles([$admin, $jefe]);
        $permission1 = Permission::create(['name' => 'asignaciones.año'])->syncRoles([$admin,  $asignacion, $jefe]);
        $permission1 = Permission::create(['name' => 'asignaciones.jefe'])->syncRoles([$admin,  $asignacion, $jefe]);
        $permission1 = Permission::create(['name' => 'asignaciones.importAsignaturas'])->syncRoles([$admin, $asignacion]);


        /* Planes */
        $permission1 = Permission::create(['name' => 'planes.index'])->syncRoles([$admin, $planeacion, $asignacion, $jefe]);
        $permission1 = Permission::create(['name' => 'planes.create'])->syncRoles([$admin, $planeacion, $asignacion, $jefe]);
        $permission1 = Permission::create(['name' => 'planes.edit'])->syncRoles([$admin, $planeacion]);
        $permission1 = Permission::create(['name' => 'planes.update'])->syncRoles([$admin, $planeacion]);
        $permission1 = Permission::create(['name' => 'planes.show'])->syncRoles([$admin, $planeacion, $asignacion, $jefe]);
        $permission1 = Permission::create(['name' => 'planes.destroy'])->syncRoles([$admin, $planeacion, $asignacion]);


        /* programaciones */
        $permission1 = Permission::create(['name' => 'programaciones.index'])->syncRoles([$admin, $planeacion]);




    }
}
