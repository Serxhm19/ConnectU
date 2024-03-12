import { ref, inject } from 'vue'
import { useRouter } from 'vue-router'
import axios from 'axios' // Importa axios para realizar solicitudes HTTP

export default function useEvents() {
    const events = ref([]) // Cambia 'categories' a 'events'
    const event = ref({
        // Cambia 'category' a 'event' y ajusta las propiedades según los datos del evento
        title: '',
        description: '',
        date: ''
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
        axios.get('/api/events/' + id) // Cambia la ruta de la API a la de eventos
            .then(response => {
                event.value = response.data.data; // Cambia 'category' a 'event'
            })
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
        getEvents,
        getEvent,
        storeEvent,
        validationErrors,
        isLoading
    }
}
