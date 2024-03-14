<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\Category;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crear el usuario administrador
        $admin = User::create([
            'name' => 'Admin',
            'surname' => 'SM',
            'nickname' => 'Admin',
            'genre' => 'Male',
            'email' => 'admin@demo.com',
            'password' => bcrypt('12345678')
        ]);

        // Crear el rol de Admin
        $adminRole = Role::create(['name' => 'Admin']);

        $adminPermissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'permission-list',
            'permission-create',
            'permission-edit',
            'permission-delete',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'post-list',
            'post-create',
            'post-edit',
            'post-delete',
            'exercise-list',
            'exercise-create',
            'exercise-edit',
            'exercise-delete',
            'category-list',
            'category-create',
            'category-edit',
            'category-delete',
            'category_event-list',
            'category_event-create',
            'category_event-edit',
            'category_event-delete',
            'event-list',
            'event-create',
            'event-edit',
            'event-delete',
            'group_user-list',
            'group_user-create',
            'group_user-edit',
            'group_user-delete',
            'promoter-list',
            'promoter-create',
            'promoter-edit',
            'promoter-delete',
            'message-list',
            'message-create',
            'message-edit',
            'message-delete',
            'group-list',
            'group-create',
            'group-edit',
            'group-delete',
        ];

        // Asignar los permisos al rol de Admin
        $adminRole->syncPermissions($adminPermissions);

        // Asignar el rol de Admin al usuario administrador
        $admin->assignRole($adminRole);

        // Crear el usuario regular
        $user = User::create([
            'name' => 'Serx',
            'surname' => 'Hernández',
            'nickname' => 'serxhm19',
            'genre' => 'Male',
            'email' => 'sergihm9@gmail.com',
            'password' => bcrypt('12345678')
        ]);

        // Crear el rol de usuario
        $userRole = Role::create(['name' => 'user']);

        // Definir los permisos para el rol de usuario
        $userPermissions = [
            'role-list',
            'permission-list',
            'user-list',
            'post-list',
            'exercise-list',
            'category-list',
            'category_event-list',
            'event-list',
            'group_user-list',
            'promoter-list',
            'message-list',
            'group-list'
            // Puedes añadir más permisos de listar aquí según sea necesario
        ];

        // Asignar los permisos al rol de usuario
        $userRole->syncPermissions($userPermissions);

        // Asignar el rol de usuario al usuario regular
        $user->assignRole($userRole);
    }
}
