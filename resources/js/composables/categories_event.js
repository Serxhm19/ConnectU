import { ref, inject } from 'vue'
import { useRouter } from 'vue-router'

export default function useCategories() {
    const categories = ref([])
    const categoryList = ref([])
    const category = ref({
        name: ''
    })

    const router = useRouter()
    const validationErrors = ref({})
    const isLoading = ref(false)
    const swal = inject('$swal')

    const getCategories = async (
        page = 1,
        search_id = '',
        search_name = '',
        search_global = '',
        order_column = 'created_at',
        order_direction = 'desc'
    ) => {
        axios.get('/api/category_event?page=' + page +
            '&search_id=' + search_id +
            '&search_name=' + search_name +
            '&search_global=' + search_global +
            '&order_column=' + order_column +
            '&order_direction=' + order_direction)
            .then(response => {
                categories.value = response.data;
            })
    }

    const getCategory = async (id) => {
        axios.get('/api/category_event/' + id)
            .then(response => {
                category.value = response.data.data;
            })
    }

    const storeCategory = async (category) => {
        if (isLoading.value) return;

        isLoading.value = true
        validationErrors.value = {}

        axios.post('/api/category_event', category)
            .then(response => {
                router.push({name: 'category_event.index'})
                swal({
                    icon: 'success',
                    title: 'Category saved successfully'
                })
            })
            .catch(error => {
                if (error.response?.data) {
                    validationErrors.value = error.response.data.errors
                }
            })
            .finally(() => isLoading.value = false)
    }

    const getCategoryList = async () => {
        axios.get('/api/category_event-list')
            .then(response => {
                categoryList.value = response.data.data;
            })
    }

    return {
        categoryList,
        categories,
        category,
        getCategories,
        getCategoryList,
        getCategory,
        storeCategory,
        validationErrors,
        isLoading
    }
}
