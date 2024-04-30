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
                'description' => 'Descripción: Únete a nosotros en esta fascinante conferencia donde expertos líderes en el campo de la inteligencia artificial compartirán sus últimas investigaciones, discutirán los desafíos éticos y explorarán el impacto futuro de esta tecnología revolucionaria.',
                'location' => 'El Prat de LL.',
                'user_id' => 2,
                'start_date' => '2024-01-15',
                'end_date' => '2024-01-25' 
            ],
            [
                'category_id' => 3,
                'name' => 'Conferencia TEDx',
                'description' => 'Lorem ipsum dolor sit amet consectetur, 
                adipiscing elit tincidunt. Odio vitae placerat ligula viverra ac mus a tellus cubilia, 
                tempor eros quam hac mauris volutpat potenti dictum tempus...Lorem ipsum dolor sit amet consectetur, 
                adipiscing elit tincidunt. Odio vitae placerat ligula viverra ac mus a tellus cubilia, 
                tempor eros quam hac mauris volutpat potenti dictum tempus...',
                'location' => 'El Prat de LL.',
                'user_id' => 2,
                'start_date' => '2024-01-15',
                'end_date' => '2024-01-25' 
            ],
            [
                'category_id' => 5,
                'name' => 'Festival de Música "Sonidos del Mundo"',
                'description' => 'Sumérgete en una experiencia musical única en el Festival "Sonidos del Mundo". Desde ritmos africanos hasta melodías asiáticas, este evento celebra la diversidad cultural a través de la música, ofreciendo actuaciones en vivo, talleres interactivos y deliciosas opciones gastronómicas de todo el mundo.',
                'location' => 'El Prat de LL.',
                'user_id' => 2,
                'start_date' => '2024-01-15',
                'end_date' => '2024-01-25' 
            ],
            [
                'category_id' => 1,
                'name' => 'Carrera de Caridad "Corriendo por la Educación"',
                'description' => 'Únete a la comunidad local en nuestra carrera anual de caridad "Corriendo por la Educación". Cada paso que des ayudará a recaudar fondos para proporcionar materiales escolares y becas para niños necesitados en nuestra región. ¡Corre, camina o anima, y ayuda a marcar la diferencia en la educación de nuestros jóvenes!',
                'location' => 'El Prat de LL.',
                'user_id' => 2,
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
                'user_id' => 2,
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
