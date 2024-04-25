import { ref, inject } from 'vue'
import { useRouter } from 'vue-router'
import axios from 'axios' // Importa axios para realizar solicitudes HTTP

export default function useEvents() {
    const promoter = ref([])
    const events = ref([])
    const promoterEvents = ref([])
    const countParticipants = ref();
    const signedUp = ref();
    const event = ref({
        id: '',
    })
    const users = ref([])
    const user = ref({
        name: '',
        surname: '',
        nickname: '',
        email: '',
        genre: '',
        password: '',
        nif: '',
        description: '',
        category_id: '',
    })

    const router = useRouter()
    const validationErrors = ref({})
    const isLoading = ref(false)
    const swal = inject('$swal')

    const getEvents = async (
        page = 1,
        search_id = '',
        search_title = '',
        search_global = '',
        order_column = 'created_at',
        order_direction = 'desc'
    ) => {
        axios.get('/api/events') // Cambia la ruta de la API a la de eventos
            .then(response => {
                events.value = response.data; // Cambia 'categories' a 'events'
            })
    }

    const getEvent = async (id) => {
        const apiUrl = `/api/events/show/${id}`;

        axios.get(apiUrl)
        .then(response => {
            event.value = response.data;
        })
        .catch(error => {
            console.error('Api error: ', error);
        });
    }

    const getEventsPromoter = async (promoter) => {
        const apiUrl = `/api/events/show/promoter/${promoter}`;

        axios.get(apiUrl)
        .then(response => {
            promoterEvents.value = response.data;
        })
        .catch(error => {
            console.error('Api error: ', error);
        });
    }

    const getPromoterEvent = async (id) => {
        const apiUrl = `/api/users/show/${id}`;

        axios.get(apiUrl)
        .then(response => {
            console.log(response.data);
            promoter.value = response.data;
        })
        .catch(error => {
            console.error('Api error: ', error);
        });
    }

    const getUsers = async (id) => {
        try {
            const response = await axios.get('/api/users/getUsers');
            
            // Utiliza el método find para encontrar el usuario con la ID deseada
            const user = response.data.find(user => user.id === id);
            console.log(user);
            // Verifica si se encontró el usuario
            if (user) {
                // Si se encontró, asigna el usuario a users.value
                users.value = user;
            } else {
                // Si no se encontró, asigna un array vacío a users.value
                users.value = [];
            }
        } catch (error) {
            console.error('Error al obtener usuarios:', error);
        }
    }
    
    const getCountParticipants = async (id) => {
        const apiUrl = `/api/user_event/count/${id}`;

        axios.get(apiUrl)
        .then(response => {
            countParticipants.value = response.data.data;
        })
        .catch(error => {
            console.error('Api error: ', error);
        });
    }

    const signedUpUser = async (user_id, event_id) => {
        const apiUrl = `/api/user_event/userInEvent/${user_id}/${event_id}`;

        axios.get(apiUrl)
        .then(response => {
            signedUp.value = response.data.data;
        })
        .catch(error => {
            console.error('Api error: ', error);
        });
    }

    const signUser = async (user_id, event_id) => {
        const apiUrl = '/api/userEvent/';
    
        try {
            const response = await axios.post(apiUrl, {
                user_id: user_id,
                event_id: event_id
            });
    
            signedUp.value = response.data.success;
        } catch (error) {
            console.error('Api error:', error);
        }
    }

    const unsignUser = async (user_id, event_id) => {
        const apiUrl = `/api/userEvent/${user_id}/${event_id}`;
    
        axios.delete(apiUrl)
        .then(response => {
            signedUp.value = !response.data.data;
        })
        .catch(error => {
            console.error('Api error: ', error);
        });
    }
    
    
    const storeEvent = async (eventData) => {
        if (isLoading.value) return;

        isLoading.value = true
        validationErrors.value = {}

        axios.post('/api/events', eventData) // Cambia la ruta de la API a la de eventos
            .then(response => {
                router.push({ name: 'event_index' }) // Cambia 'category_event.index' al nombre correcto de la ruta
                swal({
                    icon: 'success',
                    title: 'Event saved successfully' // Cambia el mensaje de éxito según el contexto de eventos
                })
            })
            .catch(error => {
                if (error.response?.data) {
                    validationErrors.value = error.response.data.errors
                }
            })
            .finally(() => isLoading.value = false)
    }

    return {
        events,
        event,
        promoterEvents,
        users,
        user,
        promoter,
        countParticipants,
        signedUp,
        getEvents,
        getEvent,
        getEventsPromoter,
        getPromoterEvent,
        getUsers,
        getCountParticipants,
        signedUpUser,
        storeEvent,
        signUser,
        unsignUser,
        validationErrors,
        isLoading
    }
}
