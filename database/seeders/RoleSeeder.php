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
        $planedor = Role::create(['name'=>'planedor']);
        $asignador = Role::create(['name'=>'asignador']);
        $coordinaciónA = Role::create(['name'=>'coordinacion']);


        /* Periodos */
        $permission1 = Permission::create(['name' => 'periodos.index'])->syncRoles([$admin,$planedor,$asignador]);
        $permission1 = Permission::create(['name' => 'periodos.create'])->syncRoles([$admin,$planedor,$asignador]);
        $permission1 = Permission::create(['name' => 'periodos.edit'])->syncRoles([$admin,$planedor,$asignador]);
        $permission1 = Permission::create(['name' => 'periodos.update'])->syncRoles([$admin,$planedor,$asignador]);
        $permission1 = Permission::create(['name' => 'periodos.show'])->syncRoles([$admin,$planedor,$asignador]);
        $permission1 = Permission::create(['name' => 'periodos.destroy'])->syncRoles([$admin,$planedor,$asignador]);


        /* Usuarios */
        $permission1 = Permission::create(['name' => 'usuarios.index'])->syncRoles([$admin,$planedor,$asignador]);
        $permission1 = Permission::create(['name' => 'usuarios.importjefes'])->syncRoles([$admin,$planedor,$asignador]);
        $permission1 = Permission::create(['name' => 'usuarios.exportjefes'])->syncRoles([$admin,$planedor,$asignador]);
        $permission1 = Permission::create(['name' => 'usuarios.createjefes'])->syncRoles([$admin,$planedor,$asignador]);
        $permission1 = Permission::create(['name' => 'usuarios.storejefes'])->syncRoles([$admin,$planedor,$asignador]);
        $permission1 = Permission::create(['name' => 'usuarios.editjefes'])->syncRoles([$admin,$planedor,$asignador]);
        $permission1 = Permission::create(['name' => 'usuarios.updatejefes'])->syncRoles([$admin,$planedor,$asignador]);
        $permission1 = Permission::create(['name' => 'usuarios.importdocentes'])->syncRoles([$admin,$planedor,$asignador]);
        $permission1 = Permission::create(['name' => 'usuarios.exportdocentes'])->syncRoles([$admin,$planedor,$asignador]);
        $permission1 = Permission::create(['name' => 'usuarios.createdocentes'])->syncRoles([$admin,$planedor,$asignador]);
        $permission1 = Permission::create(['name' => 'usuarios.storedocentes'])->syncRoles([$admin,$planedor,$asignador]);
        $permission1 = Permission::create(['name' => 'usuarios.editdocentes'])->syncRoles([$admin,$planedor,$asignador]);
        $permission1 = Permission::create(['name' => 'usuarios.updatedocentes'])->syncRoles([$admin,$planedor,$asignador]);
        $permission1 = Permission::create(['name' => 'usuarios.createjefesprovisionales'])->syncRoles([$admin,$planedor,$asignador]);
        $permission1 = Permission::create(['name' => 'usuarios.docentesporjefe'])->syncRoles([$admin,$planedor,$asignador]);
        $permission1 = Permission::create(['name' => 'usuarios.reset_password'])->syncRoles([$admin,$planedor,$asignador]);


        /* Asignaciones */
        $permission1 = Permission::create(['name' => 'asignaciones.index_asignador'])->syncRoles([$admin, $asignador, $planedor]);
        $permission1 = Permission::create(['name' => 'asignaciones.index_jefe'])->syncRoles([$admin, $jefe]);
        $permission1 = Permission::create(['name' => 'asignaciones.show'])->syncRoles([$admin, $planedor, $asignador, $jefe]);
        $permission1 = Permission::create(['name' => 'asignaciones.edit'])->syncRoles([$admin, $jefe]);
        $permission1 = Permission::create(['name' => 'asignaciones.update'])->syncRoles([$admin, $jefe]);
        $permission1 = Permission::create(['name' => 'asignaciones.año'])->syncRoles([$admin,  $asignador, $planedor, $jefe]);
        $permission1 = Permission::create(['name' => 'asignaciones.importAsignaturas'])->syncRoles([$admin, $asignador, $jefe]);
        $permission1 = Permission::create(['name' => 'asignaciones.downloadFuncion'])->syncRoles([$admin, $asignador, $planedor, $jefe]);


        /* Planes */
        $permission1 = Permission::create(['name' => 'planes.index'])->syncRoles([$admin, $planedor, $asignador, $jefe]);
        $permission1 = Permission::create(['name' => 'planes.show'])->syncRoles([$admin, $planedor, $asignador]);
        $permission1 = Permission::create(['name' => 'planes.create'])->syncRoles([$admin, $planedor, $asignador]);
        $permission1 = Permission::create(['name' => 'planes.edit'])->syncRoles([$admin, $planedor]);
        $permission1 = Permission::create(['name' => 'planes.update'])->syncRoles([$admin, $planedor]);


        /* programaciones */
        $permission1 = Permission::create(['name' => 'programaciones.index'])->syncRoles([$admin, $planedor]);




    }
}
