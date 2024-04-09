<template>
    <div class="card-body content-chats-view">
        <div class="card mb-4">
            <div class="card-body chats">
                <h3 class="mb-1 mt-1 text-center">My events</h3>
                <hr>
                <div class="list-group">
                    <div class="list-group-item list-group-chat">
                        <div v-for="event in events" :key="event.id">
                            <div class="d-flex justify-content-between mb-1">
                                <div style="display: flex;">
                                    <img src="\images\logo.png" alt="" style="height: 30px; width: 30px; border-radius: 30px;">
                                    <h6 class="ml-3 mb-1 mt-1 text-center">{{ sliceData(event.name) }}</h6>
                                </div>
                            </div>
                            <div class="d-flex w-100 justify-content-center">
                                <p class="mb-1 mt-1 text-center" style="color: #6A6A6A; font-size: 13px;">{{ formatDate(event.start_date) }} - {{ formatDate(event.end_date) }}</p>
                            </div>
                            <hr>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
    import {ref, onMounted, watch} from "vue";
    import useEvents from "../composables/events";
    import {useAbility} from '@casl/vue'

    const {events, users,  getEvents, getUsers, deleteEvent} = useEvents()
    const {can} = useAbility()

    onMounted(() => {
        getEvents()
    })

    function formatDate(dateString) {
        const date = new Date(dateString);
        const options = { day: '2-digit', month: '2-digit', year: 'numeric' };
        return date.toLocaleDateString('es-ES', options);
    }

    function sliceData(text) {
            return text.substring(0, 50) + "...";
    }
</script>

<style lang="scss" scoped>
.list-group-chat{
    border: 0;
}

.content-chats-view {
    position: fixed; /* Para fijar el contenido en la ventana del navegador */
    top: 8rem; /* Opcional: Fijar el contenido a 20px desde la parte superior */
    left: 20px; /* Opcional: Fijar el contenido a 20px desde el lado izquierdo */
    /* También puedes usar bottom o right para fijar desde la parte inferior o derecha */
    z-index: 997; /* Opcional: Definir un índice z para controlar la superposición */
    width: 23%;
}


.chats hr{
    border: 1px solid black;
}
</style>
