import { reactive, ref, inject } from 'vue'
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
            const response = await axios.get('/api/cities');

            cities.value = response.data;
        } catch (error) {
            console.error('Error al obtener usuarios:', error);
        }
    }
    
    const getProvinces = async () => {
        try {
            const response = await axios.get('/api/provinces');

            provinces.value = response.data;
        } catch (error) {
            console.error('Error al obtener usuarios:', error);
        }
    }

    const getCitiesByProvince = async (id) => {
        try {
            const response = await axios.get(`/api/cities/province/${id}`);

            cities.value = response.data;
            console.log(response.data);
        } catch (error) {
            console.error('Error al obtener usuarios:', error);
        }
    }

    return {
        cities,
        provinces,
        getCities,
        getProvinces,
        getCitiesByProvince,
    }
}
