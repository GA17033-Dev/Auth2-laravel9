<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SeederTablaRoles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crear el rol de administrador
        $rolAdmin = Role::create(['name' => 'admin']);
        // Asignar todos los permisos al rol de administrador
        $permisos = Permission::all();
        $rolAdmin->syncPermissions($permisos);

        // Crear el rol de usuario
        $rolUsuario = Role::create(['name' => 'usuario']);
        // Asignar permisos específicos al rol de usuario
        $permisosUsuario = ['ver-usuario', 'crear-usuario'];
        $rolUsuario->syncPermissions($permisosUsuario);
    }
}
