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
            [
                'category_id' => 4,
                'name' => 'Exposición de Arte Contemporáneo "Fronteras Fluidas"',
                'description' => 'Te invitamos a explorar el mundo del arte contemporáneo en nuestra exposición "Fronteras Fluidas", donde los artistas más innovadores 
                desafían los límites y reinventan las convenciones. Esta exposición única presenta una variedad de obras de arte que abordan temas como la identidad, la cultura, 
                la política y la tecnología, y te invita a reflexionar sobre el mundo que nos rodea desde una perspectiva artística.',
                'more_information' => 'En "Fronteras Fluidas", descubrirás una amplia gama de medios y estilos, desde pinturas y esculturas hasta instalaciones y performance art. 
                Los artistas seleccionados para esta exposición han sido cuidadosamente elegidos por su capacidad para capturar y comunicar ideas poderosas y relevantes en formas visualmente impactantes.',
                'location' => 2,
                'user_id' => 3,
                'start_date' => '2024-02-20',
                'end_date' => '2024-03-30' 
            ],
            [
                'category_id' => 5,
                'name' => 'Festival de Cine "Lentes del Mundo"',
                'description' => 'Te damos la bienvenida al Festival de Cine "Lentes del Mundo", donde el séptimo arte se encuentra con la diversidad cultural y las historias humanas más conmovedoras. 
                Durante dos semanas, tendrás la oportunidad de ver películas de todo el mundo, desde dramas y comedias hasta documentales y cortometrajes, que te harán reír, llorar y reflexionar.',
                'more_information' => 'Este festival es mucho más que una simple exhibición de películas. Es un lugar de encuentro para cineastas, actores, productores y amantes del cine que comparten un 
                interés común en el poder transformador del cine y su capacidad para conectar a las personas a través de historias que trascienden fronteras.',
                'location' => 4,
                'user_id' => 3,
                'start_date' => '2024-03-01',
                'end_date' => '2024-03-15' 
            ],
            [
                'category_id' => 2,
                'name' => 'Simposio de Robótica',
                'description' => 'Te invitamos a unirte al Simposio de Robótica, donde los expertos en robótica y la inteligencia artificial se reunirán para compartir sus últimos avances y descubrimientos. 
                Este evento es una oportunidad única para aprender sobre las últimas tendencias y desafíos en el campo de la robótica y la inteligencia artificial, y para conectarte con otros profesionales y entusiastas.',
                'more_information' => 'Durante el Simposio de Robótica, tendrás la oportunidad de asistir a presentaciones y demostraciones de los últimos avances en robótica y la inteligencia artificial, 
                y de participar en discusiones y debates sobre el futuro de la robótica y su impacto en la sociedad.',
                'location' => 5,
                'user_id' => 3,
                'start_date' => '2024-04-10',
                'end_date' => '2024-04-12' 
            ],
            [
                'category_id' => 3,
                'name' => 'Taller de Yoga para Principiantes',
                'description' => '¡Te invitamos a unirte a nuestro taller de yoga para principiantes, donde aprenderás los conceptos básicos del yoga y cómo puede mejorar tu bienestar y tu salud!',
                'more_information' => 'Este taller está diseñado para personas que están empezando a practicar yoga o que desean aprender sobre el yoga en un entorno amigable y relajado. 
                Durante las dos sesiones de dos horas, aprenderás a ejecutar correctamente las posiciones básicas (asanas) y los ejercicios de respiración y relajación.',
                'location' => 1,
                'user_id' => 3,
                'start_date' => '2024-05-01',
                'end_date' => '2024-05-02' 
            ],
            [
                'category_id' => 6,
                'name' => 'Congreso Internacional de Agricultura Sostenible',
                'description' => '¡Te damos la bienvenida al Congreso Internacional de Agricultura Sostenible, donde aprenderás sobre las últimas tendencias y tecnologías en agricultura sostenible y 
                cómo pueden contribuir a la solución de los desafíos globales en alimentación, medio ambiente y desarrollo económico!',
                'more_information' => 'Este congreso está diseñado para profesionales, investigadores, estudiantes y amantes de la agricultura sostenible. 
                Durante las tres días del evento, tendrás la oportunidad de asistir a presentaciones y discusiones sobre temas como la producción sostenible de alimentos, 
                la conservación de la biodiversidad y la mitigación del cambio climático.',
                'location' => 6,
                'user_id' => 3,
                'start_date' => '2024-06-01',
                'end_date' => '2024-06-03' 
            ],
            [
                'category_id' => 7,
                'name' => 'Taller de Meditación Zen',
                'description' => 'Te invitamos a unirte a nuestro taller de meditación zen, donde aprenderás técnicas y herramientas para desarrollar una práctica de meditación saludable y relajante.',
                'more_information' => 'Este taller está dirigido a personas que están interesadas en explorar la meditación zen y su impacto en la calidad de vida y el bienestar emocional. 
                Durante las tres sesiones de dos horas, aprenderás a meditar utilizando técnicas tradicionales de la meditación zen, y a integrar la meditación en tu vida diaria.',
                'location' => 3,
                'user_id' => 3,
                'start_date' => '2024-07-01',
                'end_date' => '2024-07-03' 
            ],
            [
                'category_id' => 8,
                'name' => 'Carrera de la Media Maratón Benéfica',
                'description' => '¡Te damos la bienvenida a la Carrera de la Media Maratón Benéfica, donde correrás para apoyar a nuestra comunidad y contribuir a causas valiosas!',
                'more_information' => 'Esta carrera benéfica es una oportunidad para ejercitarte y pasar un día divertido y solidario con tus amigos y familiares. 
                Todos los ingresos generados por la participación en la carrera y las donaciones de los participantes se destinarán a organizaciones benéficas que apoyan la educación, 
                la salud y la igualdad de oportunidades para todas las personas.',
                'location' => 7,
                'user_id' => 3,
                'start_date' => '2024-08-15',
                'end_date' => '2024-08-15' 
            ],
            [
                'category_id' => 9,
                'name' => 'Curso de Piano para Niños',
                'description' => '¡Te invitamos a unirte a nuestrocurso de piano para niños, donde aprenderán a tocar el piano y a desarrollar su creatividad y su amor por la música!',
                'more_information' => 'Este curso está diseñado para niños de entre 6 y 12 años que están interesados en aprender a tocar el piano y a desarrollar sus habilidades musicales. 
                Durante las diez sesiones de una hora, los niños aprenderán a tocar canciones sencillas y a desarrollar su técnica y su comprensión musical.',
                'location' => 2,
                'user_id' => 3,
                'start_date' => '2024-09-01',
                'end_date' => '2024-10-15' 
            ],
            [
                'category_id' => 10,
                'name' => 'Festival de la Cerveza Artesanal',
                'description' => '¡Te damos la bienvenida al Festival de la Cerveza Artesanal, donde podrás probar las mejores cervezas artesanales de la región y conocer a los cerveceros locales!',
                'more_information' => 'Este festival es una oportunidad para disfrutar de la cultura de la cerveza artesanal y para conocer a los cerveceros que están detrás de las mejores cervezas de la región. 
                Durante el festival, podrás probar una variedad de cervezas artesanales, desde las más clásicas hasta las más innovadoras, y participar en actividades y talleres sobre la elaboración de cerveza.',
                'location' => 8,
                'user_id' => 3,
                'start_date' => '2024-11-01',
                'end_date' => '2024-11-03' 
            ],
            [
                'category_id' => 11,
                'name' => 'Taller de Fotografía de Paisajes',
                'description' => 'Te invitamos a unirte a nuestro taller de fotografía de paisajes, donde aprenderás técnicas y herramientas para capturar la belleza de la naturaleza y crear imágenes impactantes.',
                'more_information' => 'Este taller está dirigido a personas que están interesadas en la fotografía de paisajes y su impacto en la creatividad y la expresión artística. 
                Durante las tres sesiones de cuatro horas, aprenderás a utilizar tu cámara y a aplicar técnicas de composición y exposición para crear imágenes de paisajes impactantes.',
                'location' => 9,
                'user_id' => 3,
                'start_date' => '2024-12-01',
                'end_date' => '2024-12-03' 
            ],
            [
                'category_id' => 12,
                'name' => 'Conferencia sobre Cambio Climático',
                'description' => 'Te invitamos a unirte a nuestra conferencia sobre cambio climático, donde expertos en el campo compartirán sus conocimientos y experiencias sobre este tema crítico.',
                'more_information' => 'Durante la conferencia, tendrás la oportunidad de aprender sobre las últimas investigaciones y descubrimientos en el campo del cambio climático, 
                y de participar en discusiones y debates sobre las soluciones y estrategias para abordar este desafío global.',
                'location' => 10,
                'user_id' => 2,
                'start_date' => '2024-01-10',
                'end_date' => '2024-01-12' 
            ],
            [
                'category_id' => 13,
                'name' => 'Festival de Música Electrónica',
                'description' => '¡Te damos la bienvenida al Festival de Música Electrónica, donde podrás disfrutar de las últimas tendencias y sonidos en música electrónica!',
                'more_information' => 'Durante el festival, tendrás la oportunidad de ver a algunos de los DJs y productores más destacados del mundo, y de disfrutar de una variedad de estilos y géneros electrónicos.',
                'location' => 11,
                'user_id' => 2,
                'start_date' => '2024-02-15',
                'end_date' => '2024-02-17' 
            ],
            [
                'category_id' => 14,
                'name' => 'Taller de Cocina Vegana',
                'description' => 'Te invitamos a unirte a nuestro taller de cocina vegana, donde aprenderás a preparar deliciosos platos veganos y a explorar las posibilidades de la cocina vegana.',
                'more_information' => 'Durante el taller, tendrás la oportunidad de aprender sobre los beneficios de la dieta vegana y de preparar una variedad de platos veganos, 
                desde ensaladas y sopas hasta platos principales y postres.',
                'location' => 12,
                'user_id' => 2,
                'start_date' => '2024-03-20',
                'end_date' => '2024-03-22' 
            ],
            [
                'category_id' => 15,
                'name' => 'Simposio sobre Inteligencia Artificial',
                'description' => 'Te invitamos a unirte a nuestro simposio sobre inteligencia artificial, donde expertos en el campo compartirán sus conocimientos y experiencias sobre este tema innovador.',
                'more_information' => 'Durante el simposio, tendrás la oportunidad de aprender sobre las últimas investigaciones y descubrimientos en el campo de la inteligencia artificial, 
                y de participar en discusiones y debates sobre las aplicaciones y implicaciones de la inteligencia artificial en various industries.',
                'location' => 13,
                'user_id' => 2,
                'start_date' => '2024-04-10',
                'end_date' => '2024-04-12' 
            ],
            [
                'category_id' => 16,
                'name' => 'Festival de Cine de Terror',
                'description' => '¡Te damos la bienvenida al Festival de Cine de Terror, donde podrás disfrutar de las últimas películas de terror y de clásicos del género!',
                'more_information' => 'Durante el festival, tendrás la oportunidad de ver una variedad de películas de terror, desde películas de zombies y vampiros hasta películas de suspense y miedo.',
                'location' => 14,
                'user_id' => 2,
                'start_date' => '2024-05-01',
                'end_date' => '2024-05-03' 
            ],
            [
                'category_id' => 17,
                'name' => 'Taller de Pintura Abstracta',
                'description' => 'Te invitamos a unirte a nuestro taller de pintura abstracta, donde aprenderás a explorar la creatividad y la expresión artística a través de la pintura.',
                'more_information' => 'Durante el taller, tendrás la oportunidad de aprender sobre las técnicas y herramientas de la pintura abstracta, y de crear tus propias obras de arte.',
                'location' => 15,
                'user_id' => 2,
        'start_date' => '2024-06-01',
                'end_date' => '2024-06-03' 
            ],
            [
                'category_id' => 18,
                'name' => 'Carrera de Bicicletas de Montaña',
                'description' => '¡Te damos la bienvenida a la Carrera de Bicicletas de Montaña, donde podrás competir con otros ciclistas y disfrutar de la belleza de la naturaleza!',
                'more_information' => 'Durante la carrera, tendrás la oportunidad de competir en diferentes categorías y distancias, y de disfrutar de la belleza de los paisajes naturales.',
                'location' => 16,
                'user_id' => 2,
                'start_date' => '2024-07-15',
                'end_date' => '2024-07-15' 
            ],
            [
                'category_id' => 19,
                'name' => 'Curso de Fotografía de Retrato',
                'description' => 'Te invitamos a unirte a nuestro curso de fotografía de retrato, donde aprenderás a capturar la belleza y la personalidad de las personas a través de la fotografía.',
                'more_information' => 'Durante el curso, tendrás la oportunidad de aprender sobre las técnicas y herramientas de la fotografía de retrato, y de crear tus propias obras de arte.',
                'location' => 17,
                'user_id' => 2,
                'start_date' => '2024-08-01',
                'end_date' => '2024-08-31' 
            ],
            [
                'category_id' => 20,
                'name' => 'Festival de la Cultura Indígena',
                'description' => '¡Te damos la bienvenida al Festival de la Cultura Indígena, donde podrás conocer y celebrar la diversidad y la riqueza de las culturas indígenas!',
                'more_information' => 'Durante el festival, tendrás la oportunidad de ver presentaciones de música y danza, de probar comida tradicional, y de aprender sobre las artes y artesanías indígenas.',
                'location' => 18,
                'user_id' => 2,
                'start_date' => '2024-09-15',
                'end_date' => '2024-09-15' 
            ],
            [
                'category_id' => 21,
                'name' => 'Taller de Escritura Creativa',
                'description' => 'Te invitamos a unirte a nuestro taller de escritura creativa, donde podrás explorar tu creatividad y desarrollar tus habilidades de escritura.',
                'more_information' => 'Durante el taller, tendrás la oportunidad de aprender sobre las técnicas y herramientas de la escritura creativa, y de crear tus propias obras de arte.',
                'location' => 19,
                'user_id' => 2,
                'start_date' => '2024-10-01',
                'end_date' => '2024-10-31' 
            ],
            [
                'category_id' => 22,
                'name' => 'Simposio sobre Derechos Humanos',
                'description' => 'Te invitamos a unirte a nuestro simposio sobre derechos humanos, donde expertos en el campo compartirán sus conocimientos y experiencias sobre este tema crítico.',
                'more_information' => 'Durante el simposio, tendrás la oportunidad de aprender sobre las últimas investigaciones y descubrimientos en el campo de los derechos humanos, 
                y de participar en discusionesy debates sobre las soluciones y estrategias para abordar los desafíos en materia de derechos humanos.',
                'location' => 20,
                'user_id' => 2,
                'start_date' => '2024-11-10',
                'end_date' => '2024-11-12' 
            ],
            [
                'category_id' => 23,
                'name' => 'Festival de la Cultura Urbana',
                'description' => '¡Te damos la bienvenida al Festival de la Cultura Urbana, donde podrás conocer y celebrar la diversidad y la riqueza de la cultura urbana!',
                'more_information' => 'Durante el festival, tendrás la oportunidad de ver presentaciones de música y danza, de probar comida tradicional, y de aprender sobre las artes y artesanías urbanas.',
                'location' => 21,
                'user_id' => 2,
                'start_date' => '2024-12-01',
                'end_date' => '2024-12-31' 
            ],
        ];

        foreach ($events as $event) {
            event::create($event);
        }
    }
}
