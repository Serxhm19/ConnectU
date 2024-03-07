<?php

namespace Database\Seeders;

use App\Models\category_event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateCategoryEventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'id' => 1,
                'name' => 'conferencia',
                'description' => 'Eventos donde se llevan a cabo charlas, paneles de discusión y presentaciones sobre temas específicos, tanto en persona como en línea.'
            ],
            [
                'id' => 2,
                'name' => 'taller',
                'description' => 'Sesiones de aprendizaje intensivas centradas en habilidades específicas, como talleres de cocina, seminarios de desarrollo profesional, etc.'
            ],
            [
                'id' => 3,
                'name' => 'feria comercial',
                'description' => 'Eventos donde empresas y organizaciones exhiben sus productos, servicios o ideas, tanto en entornos físicos como virtuales.'
            ],
            [
                'id' => 4,
                'name' => 'espectáculo en vivo',
                'description' => 'Presentaciones musicales, de teatro, danza u otras formas de entretenimiento en vivo.'
            ],
            [
                'id' => 5,
                'name' => 'Eventos deportivos',
                'description' => 'Competiciones deportivas, torneos, carreras y otros eventos relacionados con el deporte.'
            ],
            [
                'id' => 6,
                'name' => 'encuentro profesional',
                'description' => 'Oportunidades para establecer contactos profesionales, intercambiar ideas y colaborar con otros profesionales en tu campo.'
            ],
            [
                'id' => 7,
                'name' => 'Evento cultural',
                'description' => 'Exhibiciones de arte, festivales culturales, proyecciones de cine, lecturas de poesía, etc.'
            ],
            [
                'id' => 8,
                'name' => 'Evento gastronómico',
                'description' => 'Degustaciones de vinos, festivales de comida, clases de cocina, tours gastronómicos, etc.'
            ],
            [
                'id' => 9,
                'name' => 'estilo de vida',
                'description' => 'Clases de yoga, retiros de meditación, ferias de salud y bienestar, etc.'
            ],
            [
                'id' => 10,
                'name' => 'evento familiar',
                'description' => 'Actividades y entretenimiento diseñados para familias y niños, como espectáculos de magia, días de campo, etc.'
            ],
        ];

        foreach ($categories as $category) {
            category_event::create($category);
        }
    }
}
