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
                'description' => 'Te invitamos a experimentar la emoción de un paseo en globo aerostático, una experiencia que elevará tus sentidos a nuevas alturas. 
                Imagina flotar suavemente sobre paisajes pintorescos mientras el sol comienza a iluminar el horizonte, 
                ofreciendo vistas panorámicas impresionantes que te dejarán sin aliento.',
                'more_information' => 'Nuestro evento de paseo en globo aerostático te ofrece la oportunidad de explorar el mundo desde una perspectiva completamente nueva. 
                A bordo de nuestros coloridos globos, te elevarás lentamente hacia el cielo, dejando atrás el ajetreo y 
                el bullicio del mundo terrenal mientras te sumerges en la serenidad y la calma del aire libre.',
                'location' => 1,
                'user_id' => 2,
                'start_date' => '2024-01-15',
                'end_date' => '2024-01-25' 
            ],
            [
                'category_id' => 3,
                'name' => 'Conferencia TEDx',
                'description' => 'Te invitamos a sumergirte en una jornada de ideas innovadoras, historias inspiradoras y conversaciones que desafían el status quo. 
                TEDx es mucho más que una simple conferencia, es una plataforma dinámica donde los pensadores visionarios, 
                líderes de opinión y agentes de cambio se unen para compartir sus ideas más poderosas y transformadoras.',
                'more_information' => 'Durante este evento extraordinario, tendrás la oportunidad de presenciar una serie de charlas cautivadoras 
                impartidas por oradores expertos en una amplia gama de disciplinas. Desde la tecnología hasta el arte, la ciencia, la educación y más, 
                cada presentación está diseñada para inspirar, provocar el pensamiento y motivar la acción.',
                'location' => 1,
                'user_id' => 2,
                'start_date' => '2024-01-15',
                'end_date' => '2024-01-25' 
            ],
            [
                'category_id' => 5,
                'name' => 'Festival de Música "Sonidos del Mundo"',
                'description' => 'Te damos la bienvenida a un viaje sonoro extraordinario en el Festival de Música "Sonidos del Mundo", 
                donde los ritmos vibrantes y las melodías cautivadoras te transportarán a través de culturas y tradiciones de todo el globo. 
                Este evento único celebra la riqueza y la diversidad de la música del mundo, fusionando estilos y 
                géneros para crear una experiencia verdaderamente inolvidable.',
                'more_information' => 'En el Festival "Sonidos del Mundo", podrás sumergirte en un ambiente lleno de energía y pasión, 
                donde artistas de renombre internacional y talentos emergentes se unen para ofrecer actuaciones impresionantes que van 
                desde la música tradicional hasta las fusiones más vanguardistas. Desde los ritmos hipnóticos de África hasta los sonidos melódicos de Asia, 
                cada actuación es una celebración de la belleza y la creatividad de la música global.',
                'location' => 1,
                'user_id' => 2,
                'start_date' => '2024-01-15',
                'end_date' => '2024-01-25' 
            ],
            [
                'category_id' => 1,
                'name' => 'Carrera de Caridad "Corriendo por la Educación"',
                'description' => 'Te invitamos a participar en un evento especial que combina la pasión por correr con el deseo de contribuir a una causa noble: 
                la educación. En la Carrera de Caridad "Corriendo por la Educación", cada paso que das marca la diferencia al apoyar iniciativas educativas 
                que tienen un impacto directo en las comunidades más necesitadas.',
                'more_information' => 'Esta carrera no se trata solo de correr; se trata de unir fuerzas para cambiar vidas a través del poder transformador de la educación. 
                Cada participante, ya sea un corredor experimentado o alguien que simplemente quiere hacer una diferencia, 
                es parte de un movimiento colectivo para crear oportunidades educativas para niños y jóvenes de todo el mundo.',
                'location' => 1,
                'user_id' => 2,
                'start_date' => '2024-01-15',
                'end_date' => '2024-01-25' 
            ],


            [
                'category_id' => 2,
                'name' => 'Conferencia de Informática',
                'description' => 'Te damos la bienvenida a un evento extraordinario que reúne a mentes innovadoras y líderes de la industria para explorar 
                las últimas tendencias y avances en el campo de la informática. La Conferencia de Informática es un lugar de encuentro donde los profesionales, 
                académicos y entusiastas se reúnen para compartir conocimientos, experiencias y visiones sobre el impacto transformador de la tecnología en nuestro mundo.',
                'more_information' => 'Durante esta conferencia emocionante, tendrás la oportunidad de sumergirte en una amplia gama de temas, 
                desde inteligencia artificial y aprendizaje automático hasta ciberseguridad, computación en la nube, Internet de las cosas y más. 
                Ya seas un experto en el campo o un recién llegado curioso, encontrarás sesiones educativas y conversaciones enriquecedoras que te inspirarán y 
                te desafiarán a pensar de manera creativa sobre el futuro de la informática.',
                'location' => 1,
                'user_id' => 2,
                'start_date' => '2024-01-15',
                'end_date' => '2024-01-25' 
            ],
            [
                'category_id' => 3,
                'name' => 'Taller de acupuntura',
                'description' => '¡Te invitamos a explorar el fascinante mundo de la acupuntura en nuestro taller especializado diseñado para principiantes 
                y entusiastas por igual! La acupuntura es una antigua práctica de la medicina tradicional china que ha demostrado ser eficaz para aliviar una 
                amplia variedad de dolencias y promover el bienestar general.',
                'more_information' => 'Durante este taller, serás guiado por expertos practicantes de acupuntura que compartirán su profundo conocimiento y 
                experiencia en esta técnica milenaria. Aprenderás los fundamentos de la acupuntura, incluyendo la teoría detrás de los puntos de acupuntura, 
                los principios de diagnóstico y las técnicas de inserción de agujas.',
                'location' => 3,
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
