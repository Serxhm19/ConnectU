<?php

namespace Database\Seeders;

use App\Models\Message;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateMessageSeeder extends Seeder{
     /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $messages = [
            [
                'id' => 1,
                'message' => 'Hola',
                'user_id' => 1,
                'group_id' => 1

            ],
            [
                'id' => 2,
                'message' => 'Hola',
                'user_id' => 2,
                'group_id' => 2
            ],
            [
                'id' => 3,
                'message' => 'Hola',
                'user_id' => 3,
                'group_id' => 3
            ],
        ];

        foreach ($messages as $message) {
            Message::create($message);
        }
    }
}
