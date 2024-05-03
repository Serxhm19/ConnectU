import { ref, inject } from 'vue'
import { useRouter } from 'vue-router'
import axios from 'axios' // Importa axios para realizar solicitudes HTTP

export default function useEvents() {
    const provinces = ref([])
    const cities = ref([])

    const router = useRouter()
    const validationErrors = ref({})
    const isLoading = ref(false)
    const swal = inject('$swal')

    const getCities = async () => {
        try {
            const response = await axios.get('/api/users/getUsers');

            let user = response.data;
            console.log(user);
            if (user) {
                users.value = user;
            } else {
                users.value = [];
            }
        } catch (error) {
            console.error('Error al obtener usuarios:', error);
        }
    }
    
    const getProvinces = async (id) => {
        try {
            const response = await axios.get('/api/users/getUsers');

            let user = response.data;
            console.log(user);
            if (user) {
                users.value = user;
            } else {
                users.value = [];
            }
        } catch (error) {
            console.error('Error al obtener usuarios:', error);
        }
    }







    return {
        cities,
        provinces,
        getCities,
        getProvinces
    }
}
