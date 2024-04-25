<?php

namespace Database\Seeders;

use App\Models\user_event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateUserEventSeeder extends Seeder{
     /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $messages = [
            [
                'user_id' => 1,
                'event_id' => 1
            ],
            [
                'user_id' => 2,
                'event_id' => 2
            ],
            [
                'user_id' => 2,
                'event_id' => 3
            ],
        ];

        foreach ($messages as $message) {
            user_event::create($message);
        }
    }
}
