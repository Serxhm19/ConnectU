<?php

namespace Database\Seeders;

use App\Models\group_user;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateGroupUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $groupUsers = [
            [
                'group_id' => 1,
                'user_id' => 1
            ],
            [
                'group_id' => 2,
                'user_id' => 2
            ],
            [
                'group_id' => 3,
                'user_id' => 3
            ],
        ];

        foreach ($groupUsers as $groupUser) {
            group_user::create($groupUser);
        }
    }
}
