<template>
    <div class="card">
        <div class="table-container">
            <div class="table-header">
                <h2>Event Dashboard</h2>
            </div>
            <div v-if="loading" class="loading">
                <p>Loading events data. Please wait.</p>
                <div class="d-flex" v-for="x in 10">
                    <Skeleton v-for="x in 5" width="30%" height="20px" borderRadius="10px" class="mb-4 mr-6"></Skeleton>
                </div>
                
            </div>
            
            <div v-else class="table-body">
                <div v-if="events.length === 0" class="empty">
                    No events found.
                </div>
                <div v-else class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Location</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(event, index) in events" :key="event.id">
                                <td>{{ event.name }}</td>
                                <td>{{ event.location }}</td>
                                <td>{{ formatDate(event.start_date) }}</td>
                                <td>{{ formatDate(event.end_date) }}</td>
                                <td>
                                    <span v-if="isEventExpired(event.end_date)" class="badge bg-danger">Expired</span>
                                    <span v-else class="badge bg-success">Active</span>
                                </td>
                                <td>
                                    <router-link :to="{ name: 'events.update', params: { id: event.id } }">
                                        <button class="btn btn-primary" title="Edit">
                                            <i class="icon pi pi-pencil"></i>
                                        </button>
                                    </router-link>
                                    <button class="btn btn-danger" title="Delete" @click="confirm(event.id, index)">
                                        <i class="icon pi pi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { useStore } from 'vuex';
import axios from "axios";
import { ref, inject, onMounted, computed } from "vue"
import useSites from "../../../composables/sites";

import Skeleton from "primevue/skeleton";
const { cities, getCities } = useSites()
const loading = ref(true);

onMounted(() => {
    const vuexData = localStorage.getItem("vuex");
    const vuexArray = JSON.parse(vuexData);
    let id = vuexArray.auth.user.id;
    axios.get('/api/events/promoter/' + id)
        .then(response => {
            events.value = response.data;
            loading.value = false;

            events.value.forEach(event => {
                const cityId = event.location;
                const cityName = getName(cities.value, cityId);
                event.location = cityName;
            });
        })
        .catch(error => {
            console.error('Error fetching events:', error);
            loading.value = false;
        });
});


await getCities()


const store = useStore();
const user = computed(() => store.state.auth.user)
const events = ref([]);
const swal = inject('$swal');

function confirm(id, index) {
    swal.fire({
        title: '¿Estás seguro?',
        text: '¿Quieres eliminar este evento?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            deleteEvent(id, index);
        }
    });
}

const deleteEvent = (id, index) => {
    axios.delete(`/api/events/${id}`)
        .then(response => {
            events.value.splice(index, 1);

            swal.fire({
                title: 'Evento eliminada',
                text: 'El evento se a eliminado correctamente',
                icon: 'success',
                confirmButtonText: 'Aceptar'
            });
        })
        .catch(error => {
            swal.fire({
                title: 'Error',
                text: 'Ocurrió un error al eliminar el evento',
                icon: 'error',
                confirmButtonText: 'Aceptar'
            });
        });
}

function formatDate(dateString) {
    const date = new Date(dateString);
    const options = { day: '2-digit', month: '2-digit', year: 'numeric' };
    return date.toLocaleDateString('es-ES', options);
}

function isEventExpired(endDate) {
    const currentDate = new Date();
    const eventEndDate = new Date(endDate);

    return eventEndDate < currentDate;
}

const getName = (array, id) => {
    const result = array.find(object => object.id === id);
    return result ? result.name : 'Categoría no encontrada';
};



</script>
<style scoped lang="scss">
@import "../../../../../sass/promoter.scss";



</style>