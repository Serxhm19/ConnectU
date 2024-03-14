<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
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

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
