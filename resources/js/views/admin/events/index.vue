<template>
    <div class="card">
        <h1>hola index</h1>
        <table class="table table-hover table-sm">
            <thead class="bg-dark text-light">
                <tr>
                    <th width="50" class="text-center">#</th>
                    <th>Name</th>
                    <th>description</th>
                    <th>start date</th>
                    <th>end date</th>
                    <th class="text-center" width="200">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(event, index) in events">
                    <td class="text-center">{{ event.id }}</td>
                    <td>{{ event.name }}</td>
                    <td>{{ event.description }}</td>
                    <td>{{ event.start_date }}</td>
                    <td>{{ event.end_date }}</td>
                    <td class="text-center">
                        <router-link :to="{name: 'events.update', params: {id:event.id}}" class="btn btn-warning mr-1">Edit</router-link>
                        <button class="btn btn-danger" @click="confirm(event.id, index)">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template> 

<script setup>
    import axios from "axios";
    import {ref, inject, onMounted} from "vue"
    const events = ref();
    const swal = inject('$swal');

    onMounted(() => {
        // console.log('mi vista')
        axios.get('/api/events')
        .then(response =>  {
            events.value = response.data;
        })
    });

    function confirm(id, index) {
        console.log('hola confirm');
    }
    
    const deleteTask = (id, index) =>{
        console.log('hola deleteTask');
    }

</script>


<style>


</style>