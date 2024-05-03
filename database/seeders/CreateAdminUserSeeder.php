<?php

namespace Database\Seeders;

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

        // Crear el usuario administrador
        $promoter = User::create([
            'name' => 'Test',
            'surname' => 'Event',
            'nickname' => 'TestEvent',
            'genre' => 'Other',
            'email' => 'TestEvent@gmail.com',
            'password' => bcrypt('12345678'),
            'NIF' => '123456E',
            'description' => 'Nuestra pasión por la aventura y la emoción se fusiona con nuestra experiencia en 
            la organización de eventos para crear experiencias únicas en el cielo. Nuestro objetivo es llevar a 
            los participantes a nuevas alturas y hacer que vivan momentos inolvidables nuestraentras disfrutan del 
            paisaje desde una perspectiva única.',
            'category_id' => 1
        ]);
        
        // Crear el rol de Admin
        $promoterRole = Role::create(['name' => 'Promoter']);
        
        $promoterPermissions = [
            'user-list',
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
        $promoterRole->syncPermissions($promoterPermissions);
        $promoter->assignRole($promoterRole);

        // Crear el usuario regular
        $user = User::create([
            'name' => 'Manu',
            'surname' => 'Caler',
            'nickname' => 'mcy03',
            'genre' => 'Male',
            'email' => 'mcy03@gmail.com',
            'password' => bcrypt('12345678')
        ]);
        // Crear el rol de usuario
        $userRole = Role::create(['name' => 'user']);

        // Definir los permisos para el rol de usuario
        $userPermissions = [
            'user-list',
            'user-edit',
            'user-delete',
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
