<template>
    <div class="grid">
        <div class="col-12">
            <div class="card"
                style="background-image: url('/images/logo.png'); background-size: cover; border: 2px solid white;">
                <div class="card-body">
                    <div class="d-flex justify-content-between pb-2 mb-4">
                    </div>
                </div>
                <div class="d-flex align-items-left">
                    <img src="\images\logo.png" class="profile-pic" alt="Profile Picture">
                </div>
            </div>
        </div>
    </div>

    <div class="grid">
        <div class="col-4">
            <div class="card">
                <div class="col-12">
                    <div>
                        <button type="button" class="btn btn-secondary button-edit pi pi-fw pi-user-edit"></button>
                    </div>
                    <h3 class="nickname">
                        @{{ user.nickname }}
                    </h3>
                </div>
                <div>
                    <div class="col-4">
                        <h2 class="name">
                            {{ user.name }} {{ user.surname }}
                        </h2>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <h1>Hola</h1>
                </div>
            </div>
        </div>

        <div class="col-8">
            <div class="card row flex justify-content-around flex-row">
                <div class="card mb-12" style="border: 1px solid black;" v-for="(event, index) in events" :key="index">
                    <div class="row g-2 col-12">
                        <div class="col-md-4">
                            <img src="\images\logo.png" alt="Image" class="img-fluid rounded-start">
                        </div>
                        <div class="col-md-8">
                            <div>
                                <h1 class="card-title">{{ event.name }}</h1>
                                <p class="card-text">{{ event.description }}</p>
                                <p class="card-text"><small class="text-body-secondary">{{ formatDate(event.start_date)
                                        }} - {{ formatDate(event.end_date) }}</small></p>
                                <div class="d-flex align-items-center">
                                    <router-link :to="{ name: 'events.update', params: { id: event.id } }"
                                        class="btn btn-warning mr-3">Editar</router-link>
                                    <button class="btn btn-danger" @click="confirm(event.id, index)">Cancelar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>

const store = useStore();
const user = computed(() => store.state.auth.user)
import { useStore } from 'vuex';
import axios from "axios";
import { ref, inject, onMounted, computed, onBeforeUnmount } from "vue"
const events = ref([]);
const swal = inject('$swal');

function stripHtmlTags(html) {
    const doc = new DOMParser().parseFromString(html, 'text/html');
    return doc.body.textContent || "";
}

onMounted(() => {
    // console.log('mi vista')
    const vuexData = localStorage.getItem("vuex");
    const vuexArray = JSON.parse(vuexData);
    let id = vuexArray.auth.user.id;

    axios.get('/api/events/promoter/' + id)
        .then(response => {
            events.value = response.data;+

            console.log(events.value);

            events.value.forEach(event => {
                event.description = stripHtmlTags(event.description);
            });

        })
});

function confirm(id, index) {
    swal.fire({
        title: '¿Estás seguro?',
        text: '¿Quieres eliminar esta tarea?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            deleteTask(id, index);
        }
    });
}

const deleteTask = (id, index) => {
    axios.delete(`/api/events/${id}`)
        .then(response => {
            events.value.splice(index, 1);

            swal.fire({
                title: 'Tarea eliminada',
                text: 'La tarea se eliminó correctamente',
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

</script>
<style scoped>
.profile-pic {
    top: 9rem;
    left: 2.5rem;
    position: relative;
    z-index: 3;
    width: 200px;
    height: 200px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid rgb(255, 255, 255);

}

.nickname {
    margin-top: 3rem;
    color: rgb(0, 0, 0);
    font-size: 28px;
    margin-left: 1rem;
}

.name {
    color: rgb(0, 0, 0);
    font-size: 20px;
    margin-top: -1rem;
    margin-left: 1rem;

}

.email {
    color: rgb(0, 0, 0);
    font-size: 20px;
    margin-top: 2px;
}

.button-edit {
    top: 1rem;
    left: 32.5rem;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    margin-left: -1rem;
    margin-top: -1rem;
}

.card-event {
    display: flex;
}
</style>
