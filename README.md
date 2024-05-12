**ConnectU - Plataforma de Eventos y Networking**

---

### Descripción:

ConnectU es una plataforma web diseñada para la organización de eventos y el networking entre usuarios. Su objetivo principal es ofrecer una experiencia interactiva y enriquecedora donde los usuarios pueden descubrir, participar y compartir eventos de diversa índole, desde conferencias y seminarios hasta actividades sociales y deportivas.

### Características principales:

1. **Explora eventos:** Los usuarios pueden navegar por una amplia variedad de eventos organizados por diferentes promotores. La plataforma ofrece herramientas de búsqueda y filtros para facilitar la exploración y encontrar eventos relevantes según intereses y ubicación.

2. **Participa en eventos:** Los usuarios pueden inscribirse y participar en eventos directamente desde la plataforma. Se proporciona información detallada sobre cada evento, incluyendo la descripción, fecha, ubicación y requisitos de inscripción.

3. **Networking:** ConnectU fomenta la interacción entre usuarios al permitirles conectarse entre sí, compartir experiencias y establecer contactos profesionales. Los perfiles de usuario incluyen información personal y profesional, facilitando la conexión y el networking.

4. **Gestión de eventos:** Los promotores pueden crear y gestionar eventos a través de la plataforma. Pueden personalizar la información del evento, gestionar inscripciones de participantes, y promocionar sus eventos para llegar a una audiencia más amplia.

5. **Perfil personalizado:** Cada usuario tiene un perfil personalizado donde pueden gestionar su información, ver eventos a los que están inscritos, y seguir a otros usuarios para mantenerse al día con sus actividades y eventos.

### Tecnologías utilizadas:

- **Vue.js:** Framework de JavaScript para la construcción de interfaces de usuario interactivas.
- **Vue Router:** Librería para la gestión de rutas en aplicaciones Vue.js.
- **Vuex:** Gestor de estados para aplicaciones Vue.js.
- **PrimeVue:** Biblioteca de componentes UI basada en Vue.js para un diseño atractivo y funcional.
- **Axios:** Cliente HTTP basado en promesas para realizar solicitudes HTTP desde el navegador o Node.js.

### Instalación y ejecución:

1. Clona el repositorio desde GitHub: `git clone https://github.com/Serxhm19/ConnectU.git`
2. Instala las dependencias: `npm install`
3. Configura el archivo `.env` con las variables de entorno necesarias.
4. Ejecuta las migraciones de la base de datos: `npm run migrate`
5. Ejecuta las migraciones: `php artisan migrate:fresh`
6. Ejecuta los seeders: `php artisan db:seed`
5. Instala Pusher para la comunicación en tiempo real: `npm install pusher`
6. Inicia el servidor de desarrollo: `npm run dev`
7. Accede a la aplicación desde tu navegador: `http://localhost:8000`
