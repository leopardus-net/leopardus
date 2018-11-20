<?php

use Illuminate\Database\Seeder;

class PermissionsRolesSeeder extends Seeder
{
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['name' => 'Super Admin', 'route' => '/admin'],
            ['name' => 'Web Master', 'route' => '/admin']
        ];

        foreach($roles as $role) {
            roles()->add($role);
        }        

        $permisos = [
            ['name' => 'Tablero', 'slug' => 'dashboard'],
            ['name' => 'Configuraciones', 'slug' => 'settings.menu'],
            ['name' => 'Configuraciones basicas', 'slug' => 'settings.basic'],
            ['name' => 'Idiomas', 'slug' => 'settings.languajes'],
            ['name' => 'Traducciones', 'slug' => 'settings.translations'],
            ['name' => 'Left Sidebar', 'slug' => 'settings.left-sidebar'],
            ['name' => 'Cabecera', 'slug' => 'settings.header'],
            ['name' => 'Roles y permisos', 'slug' => 'settings.permissions'],
            ['name' => 'Usuarios', 'slug' => 'settings.users'],
        ];

        foreach ($permisos as $data) {
            permissions()->add($data);
        }
    }
}
