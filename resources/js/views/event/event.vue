<template>
    <section class="banner-event">
        <div class="card event-card ml-6 mr-6 mt-3">
            <div class="event-header d-flex align-items-center">
                <img src="/images/eventoPrueba.webp" alt=""/>
                <h1 class="name-event text-left ml-7">{{ event.name }}</h1>
            </div>
        </div>
    </section>
</template>
  



<script setup>
import { onMounted, reactive, watchEffect } from "vue";
import { useRoute } from "vue-router";
import useEvents from "@/composables/events";

const {event, events, users,  getEvent, getUsers, deleteEvent} = useEvents()
const route = useRoute()


onMounted(async () => {
    await getEvent(route.params.id);
})


</script>

<style>
    .event-card{
        padding: 0;
        border-radius: 20px;
    }
    .event-header{
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        min-height: 300px;

        width: 100%;
        position: relative;

        border-radius: 20px 20px 0px 0px;
    }

    .event-header img{
        width: 100%;
    }

    .event-header::after{
        content: "";
        width: 100%;
        height: 200px;
        position: absolute;
        left: 0;
        bottom: 0;
        background-image: linear-gradient(90deg, #303030 0%, rgba(48, 48, 48, 0.735) 42.5%, rgba(48, 48, 48, 0.325957) 80.5%, rgba(48, 48, 48, 0) 100%);
    }

    .name-event{
        color: white;
        
    }
</style>
