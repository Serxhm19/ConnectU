<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionTableSeeder::class);
        $this->call(CreateAdminUserSeeder::class);
        $this->call(CreateCategoryEventSeeder::class);
        $this->call(CreatePromoterSeeder::class);
        $this->call(CreateEventSeeder::class);
        $this->call(CreateGroupSeeder::class);

        $this->call(CreateMessageSeeder::class);
       
        $this->call(CreateGroupUserSeeder::class);

//        $this->call(RoleSeeder::class);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
