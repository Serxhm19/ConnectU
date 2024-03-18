<template>
    <div class="card">
        <h1>Mis eventos</h1>

        <div class="container">
            <div class="row flex justify-content-around">
                <div v-for="(event, index) in events" :key="index" class="card col-sm-3">
                    <p>{{ event.name }}</p>
                    <p>{{ event.description }}</p>
                    <p>{{ formatDate(event.start_date) }} - {{ formatDate(event.end_date) }}</p>
                    <div class="flex justify-content-around">
                        <router-link :to="{ name: 'events.update', params: { id: event.id } }" class="btn btn-warning mr-3">Editar</router-link>
                        <button class="btn btn-danger" @click="confirm(event.id, index)">Cancelar</button>
                    </div>
                </div>
                <div v-for="(event, index) in events" :key="index" class="card col-sm-3">
                    <p>{{ event.name }}</p>
                    <p>{{ event.description }}</p>
                    <p>{{ formatDate(event.start_date) }} - {{ formatDate(event.end_date) }}</p>
                    <div class="flex justify-content-around">
                        <router-link :to="{ name: 'events.update', params: { id: event.id } }" class="btn btn-warning mr-3">Editar</router-link>
                        <button class="btn btn-danger" @click="confirm(event.id, index)">Cancelar</button>
                    </div>
                </div>
                <div v-for="(event, index) in events" :key="index" class="card col-sm-3">
                    <p>{{ event.name }}</p>
                    <p>{{ event.description }}</p>
                    <p>{{ formatDate(event.start_date) }} - {{ formatDate(event.end_date) }}</p>
                    <div class="flex justify-content-around">
                        <router-link :to="{ name: 'events.update', params: { id: event.id } }" class="btn btn-warning mr-3">Editar</router-link>
                        <button class="btn btn-danger" @click="confirm(event.id, index)">Cancelar</button>
                    </div>
                </div>
                
            </div>
        </div>

        <table v-if="events.length > 0" class="table table-hover table-sm">
            
            <thead class="bg-dark text-light">
                <tr class="text-center">
                <th>Nombre del evento</th>
                <th>Descripción del evento</th>
                <th>Fecha de inicio</th>
                <th>Fecha de finalización</th>
                <th width="200">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(event, index) in events" :key="index" class="text-center">
                <td>{{ event.name }}</td>
                <td>{{ event.description }}</td>
                <td>{{ formatDate(event.start_date) }}</td>
                <td>{{ formatDate(event.end_date) }}</td>
                <td>
                    <router-link :to="{ name: 'events.update', params: { id: event.id } }" class="btn btn-warning mr-3">Editar</router-link>
                    <button class="btn btn-danger" @click="confirm(event.id, index)">Cancelar</button>
                </td>
                </tr>
            </tbody>
        </table>

        <div v-else class="d-flex justify-content-around align-items-center flex-wrap">
            <div class="alert alert-info p-4 m-4" style="width: 50%;">
                <h4 class="alert-heading">¡No tienes ningún evento creado!</h4>
                <p class="mb-0">¿Por qué no comienzas creando uno ahora mismo?</p>
            </div>
            <router-link :to="{ name: 'events.create' }" class="btn btn-primary btn-lg m-4">Crear Evento</router-link>
        </div>
        
    </div>

    
</template> 

<script setup>
    import axios from "axios";
    import {ref, inject, onMounted} from "vue"
    const events = ref([]);
    const swal = inject('$swal');

    onMounted(() => {
        // console.log('mi vista')
        const vuexData = localStorage.getItem("vuex");
        const vuexArray = JSON.parse(vuexData);
        let id = vuexArray.auth.user.id;

        axios.get('/api/events/promoter/'+id)
        .then(response =>  {
            events.value = response.data;
            console.log(events.value);
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
    
    const deleteTask = (id, index) =>{
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
    .table-responsive {
        overflow-x: auto;
    }
</style>