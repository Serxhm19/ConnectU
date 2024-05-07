import { reactive, ref, inject } from 'vue'
import { useRouter } from 'vue-router'
import axios from 'axios'

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
        const apiUrl = `/api/cities/province/${id}`;
        axios.get(apiUrl)
        .then(response => {
            cities.value = response;
            console.log(cities.value);
        })
        .catch(error => {
            console.error('Api error: ', error);
        });
    }

    return {
        cities,
        provinces,
        getCities,
        getProvinces,
        getCitiesByProvince,
    }
}
