import { ref, inject } from 'vue'
import { useRouter } from 'vue-router'

export default function usePromoters() {
    const promoters = ref([])
    const promoter = ref({
        name: ''
    })

    const router = useRouter()
    const validationErrors = ref({})
    const isLoading = ref(false)
    const swal = inject('$swal')

    const getPromoters = async (
        page = 1,
        search_id = '',
        search_title = '',
        search_global = '',
        order_column = 'created_at',
        order_direction = 'desc'
    ) => {
        axios.get('/api/promoter?page=' + page +
            '&search_id=' + search_id +
            '&search_title=' + search_title +
            '&search_global=' + search_global +
            '&order_column=' + order_column +
            '&order_direction=' + order_direction)
            .then(response => {
                promoters.value = response.data;
            })
    }

    const getPromoter = async (id) => {
        axios.get('/api/promoter/' + id)
            .then(response => {
                promoter.value = response.data.data;
            })
    }

    const storePromoter = async (promoter) => {
        if (isLoading.value) return;

        isLoading.value = true
        validationErrors.value = {}

        let serializedPost = new FormData()
        for (let item in promoter) {
            if (promoter.hasOwnProperty(item)) {
                serializedPost.append(item, promoter[item])
            }
        }

        axios.post('/api/promoters', serializedPost)
            .then(response => {
                router.push({name: 'promoters.index'})
                swal({
                    icon: 'success',
                    title: 'User saved successfully'
                })
            })
            .catch(error => {
                if (error.response?.data) {
                    validationErrors.value = error.response.data.errors
                }
            })
            .finally(() => isLoading.value = false)
    }

    const updatePromoter = async (promoter) => {
        if (isLoading.value) return;

        isLoading.value = true
        validationErrors.value = {}

        axios.put('/api/promoters/' + promoter.id, promoter)
            .then(response => {
                router.push({name: 'promoters.index'})
                swal({
                    icon: 'success',
                    title: 'User updated successfully'
                })
            })
            .catch(error => {
                if (error.response?.data) {
                    validationErrors.value = error.response.data.errors
                }
            })
            .finally(() => isLoading.value = false)
    }

    const deletePromoter = async (id) => {
        swal({
            title: 'Are you sure?',
            text: 'You won\'t be able to revert this action!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            confirmButtonColor: '#ef4444',
            timer: 20000,
            timerProgressBar: true,
            reverseButtons: true
        })
            .then(result => {
                if (result.isConfirmed) {
                    axios.delete('/api/promoters/' + id)
                        .then(response => {
                            getUsers()
                            router.push({name: 'promoters.index'})
                            swal({
                                icon: 'success',
                                title: 'User deleted successfully'
                            })
                        })
                        .catch(error => {
                            swal({
                                icon: 'error',
                                title: 'Something went wrong'
                            })
                        })
                }
            })
    }

    return {
        promoters,
        promoter,
        getPromoter,
        getPromoters,
        storePromoter,
        updatePromoter,
        deletePromoter,
        validationErrors,
        isLoading
    }
}
