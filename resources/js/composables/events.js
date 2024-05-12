import { ref, inject } from 'vue'
import { useRouter } from 'vue-router'
import axios from 'axios' // Importa axios para realizar solicitudes HTTP

export default function useEvents() {
    const promoter = ref([])
    const events = ref([])
    const bannerEvent = ref ()
    const isLoadingEvents = ref(true);
    const isLoadingUserEvents = ref(true);
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
    const events_user = ref([])
    const router = useRouter()
    const validationErrors = ref({})
    const isLoading = ref(false)
    const swal = inject('$swal')

    const getEvents = async () => {
        axios.get('/api/events')
        .then(response => {
            events.value = response.data.data;
            isLoadingEvents.value = false;
        })
    }

    const getEventsFilter = async (
        page = 1,
        search_global = '',
        search_category = '',
        search_id = '',
        search_name = '',
        search_description = '',
        search_location = '',
        search_start_date = '',
        search_end_date = '',
        search_user_id = '',
        order_column = 'created_at',
        order_direction = 'desc',
    ) => {
        axios.get('/api/events?page='+ page +
        '&search_global=' + search_global +
        '&search_category=' + search_category +
        '&search_id=' + search_id +
        '&search_name=' + search_name +
        '&search_description=' + search_description +
        '&search_location=' + search_location +
        '&search_start_date=' + search_start_date +
        '&search_end_date=' + search_end_date +
        '&search_user_id=' + search_user_id +
        '&order_column=' + order_column +
        '&order_direction=' + order_direction)
        .then(response => {
            console.log('events filtered')
            console.log(response.data.data)
            events.value = response.data.data;
            isLoadingEvents.value = false;
        })
    }

    const getEvent = async (id) => {
        const apiUrl = `/api/events/show/${id}`;

        axios.get(apiUrl)
        .then(response => {
            event.value = response.data;

            const apiUrlPromoter = `/api/users/show/${response.data.user_id}`;

            axios.get(apiUrlPromoter)
            .then(response => {
                promoter.value = response.data;

                const apiUrl = `/api/events/show/promoter/${promoter.value.id}`;

                axios.get(apiUrl)
                .then(response => {
                    promoterEvents.value = response.data;
                    
                })
                .catch(error => {
                    console.error('Api error: ', error);
                });
            })
            .catch(error => {
                console.error('Api error: ', error);
            });
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
            promoter.value = response.data.data;
        })
        .catch(error => {
            console.error('Api error: ', error);
        });
    }

    const getUsers = async (id) => {
        try {
            const response = await axios.get('/api/users/getUsers');

            let user = response.data;

            if (user) {
                users.value = user;
            } else {
                users.value = [];
            }
        } catch (error) {
            console.error('Error al obtener usuarios:', error);
        }
    }

    const getUrlBannerEvent = async (id) => {
        try {
            const response = await axios.get(`/api/events/getImageBanner/${id}`);

            bannerEvent.value = response.data.data;
        } catch (error) {
            console.error('Error al obtener media del evento: ', error);
        }
    }

    const getEventsUser = async (user_id) => {
        let apiUrl = `/api/user_event/events_user/${user_id}`;
    
        axios.get(apiUrl)
            .then(response => {
                let id_events = response.data;
    
                id_events.forEach(id => {
                    let eventUrl = `/api/events/show/${id}`;
    
                    axios.get(eventUrl)
                        .then(response => {
                            events_user.value.push(response.data);
                        })
                        .catch(error => {
                            console.error(`Error al obtener el evento ${id}: `, error);
                        });
                });

                isLoadingUserEvents.value = false;
            })
            .catch(error => {
                console.error(`Error de API al obtener los eventos del usaurio ${user_id}: `, error);
            });  
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
        isLoadingEvents,
        isLoadingUserEvents,
        bannerEvent,
        events,
        event,
        promoterEvents,
        users,
        user,
        promoter,
        countParticipants,
        events_user,
        signedUp,
        getEvents,
        getEventsFilter,
        getEvent,
        getUrlBannerEvent,
        getEventsPromoter,
        getPromoterEvent,
        getUsers,
        getCountParticipants,
        getEventsUser,
        signedUpUser,
        storeEvent,
        signUser,
        unsignUser,
        validationErrors,
        isLoading
    }
}
