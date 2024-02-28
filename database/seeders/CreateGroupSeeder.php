<?php

namespace Database\Seeders;

use App\Models\group;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $groups = [
            [
                'event_id' => 1,
                'start_date' => '2024-06-10',
                'end_date' => '2024-06-13'
            ],
            [
                'event_id' => 2,
                'start_date' => '2024-02-28',
                'end_date' => '2024-03-15'
            ],
            [
                'event_id' => 3,
                'start_date' => '2024-01-15',
                'end_date' => '2024-01-20'
            ],
        ];

        foreach ($groups as $group) {
            group::create($group);
        }
    }
}
