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
                'name' => 'Paseo en globo aerostático',
                'description' => 'Lorem ipsum dolor sit amet consectetur, 
                adipiscing elit tincidunt. Odio vitae placerat ligula viverra ac mus a tellus cubilia, 
                tempor eros quam hac mauris volutpat potenti dictum tempus...Lorem ipsum dolor sit amet consectetur, 
                adipiscing elit tincidunt. Odio vitae placerat ligula viverra ac mus a tellus cubilia, 
                tempor eros quam hac mauris volutpat potenti dictum tempus...',
                'location' => 'Esplugues de LL.',
                'user_id' => 1,
                'start_date' => '2024-01-15',
                'end_date' => '2024-01-25' 
            ],
            [
                'category_id' => 2,
                'name' => 'Conferencia de Informática',
                'description' => 'Lorem ipsum dolor sit amet consectetur, 
                adipiscing elit tincidunt. Odio vitae placerat ligula viverra ac mus a tellus cubilia, 
                tempor eros quam hac mauris volutpat potenti dictum tempus...Lorem ipsum dolor sit amet consectetur, 
                adipiscing elit tincidunt. Odio vitae placerat ligula viverra ac mus a tellus cubilia, 
                tempor eros quam hac mauris volutpat potenti dictum tempus...',
                'location' => 'El Prat de LL.',
                'user_id' => 1,
                'start_date' => '2024-01-15',
                'end_date' => '2024-01-25' 
            ],
            [
                'category_id' => 3,
                'name' => 'Taller de acupuntura',
                'description' => 'Lorem ipsum dolor sit amet consectetur, 
                adipiscing elit tincidunt. Odio vitae placerat ligula viverra ac mus a tellus cubilia, 
                tempor eros quam hac mauris volutpat potenti dictum tempus...Lorem ipsum dolor sit amet consectetur, 
                adipiscing elit tincidunt. Odio vitae placerat ligula viverra ac mus a tellus cubilia, 
                tempor eros quam hac mauris volutpat potenti dictum tempus...',
                'location' => 'Hospitalet de LL.',
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
