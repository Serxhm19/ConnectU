<?php

namespace Database\Seeders;

use App\Models\event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateEventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $events = [
            [
                'category_id' => 1,
                'name' => 'event 1',
                'description' => 'description event 1',
                'user_id' => 1,
                'start_date' => '2024-01-15',
                'end_date' => '2024-01-25' 
            ],
            [
                'category_id' => 2,
                'name' => 'event 2',
                'description' => 'description event 2',
                'user_id' => 1,
                'start_date' => '2024-01-15',
                'end_date' => '2024-01-25' 
            ],
            [
                'category_id' => 3,
                'name' => 'event 3',
                'description' => 'no visto',
                'user_id' => 2,
                'start_date' => '2024-01-15',
                'end_date' => '2024-01-25' 
            ],
        ];

        foreach ($events as $event) {
            event::create($event);
        }
    }
}
