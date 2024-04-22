<template>
    <div class="grid">
        <section class="card event ml-6 mr-6 mt-3 col-12 grid">
            <div class="event-header d-flex flex-column justify-content-center col-12">
                <div class="name-container">
                    <h1 class="name-event text-left ml-7">{{ event.name }}</h1>
                    <p class="by-text">By TestEvent</p>
                </div>
            </div>
            <div class="content-event col-12">
                <p>{{ event.description }}</p>
                <img src="/images/eventoPrueba.webp" alt="">
                <p>{{ event.description }}</p>
            </div>
            <div class="grid">
                <div class="col-0 lg:col-0 xl:col-3"></div>
                <div class="content-promoter col-12 lg:col-12 xl:col-6">
                    <img class="promoter-icon" src="/images/connectu.svg" alt="">
                    <h4 class="name-promoter">TestEventos</h4>
                    <p class="description-promoter">
                        Lorem ipsum dolor sit amet consectetur, adipiscing elit tincidunt. 
                        Odio vitae placerat ligula viverra ac mus a tellus cubilia, tempor eros quam hac mauris volutpat potenti dictum tempus...
                    </p>
                </div>
                <div class="col-0 lg:col-0 xl:col-3"></div>
            </div>
            
            <section class="other-events col-12 grid d-flex justify-content-evenly mb-6">
                <div v-for="(evento, index) in promoterEvents.slice(-3)" :key="index" class="col-3 d-flex justify-content-center event-slader">
                    <div class="card" style="width: 25rem;">
                        <img class="card-img-top" src="/images/eventoPrueba.webp" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title title-other-event">{{ evento.name }}</h5>
                            <p class="card-text">{{ sliceData(evento.description, 150) }}</p>
                        </div>
                        <button class="button-slader btn">Ver evento...</button>
                    </div>
                </div>
            </section>
        </section>
    </div>
</template>
  



<script setup>
import { onMounted, reactive, watchEffect, ref } from "vue";
import { useRoute } from "vue-router";
import Carousel from "primevue/carousel";
import Tag from "primevue/tag";
import useEvents from "@/composables/events";

const {event, events, promoter, promoterEvents, users,  getEvent, getEventsPromoter, getPromoterEvent, getUsers, deleteEvent} = useEvents()
const route = useRoute()


onMounted(async () => {

    await getEvent(route.params.id);
    await getEventsPromoter(1);
   
})

getUsers(event.value.user_id);

function sliceData(text, numSlice) {
    return text.substring(0, numSlice) + "...";
}


</script>

<style>
    .event {
        padding: 0;
        border-radius: 20px;
        width: 95%;
    }

    .event-header {
        background-image: url('/images/eventoPrueba.webp');
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        min-height: 400px;
        width: 100%;
        position: relative;
        border-radius: 20px 20px 0px 0px;
        border-bottom: 6px solid #0094FF;
    }

    .event-header::after {
        content: "";
        width: 100%;
        height: 100%;
        position: absolute;
        left: 0;
        bottom: 0;
        background-image: linear-gradient(90deg, #303030 0%, rgba(48, 48, 48, 0.735) 42.5%, rgba(48, 48, 48, 0.325957) 80.5%, rgba(48, 48, 48, 0) 100%);
        border-radius: 20px 20px 0px 0px;
    }

    .event-header h1 {
        color: white;
        position: relative;
        z-index: 1;
        margin-bottom: 0;
    }

    .by-text{
        color: white;
        position: relative;
        z-index: 1;
        margin-left: 350px;
        font-size: 20px;
    }

    .content-event{
        padding: 30px 70px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .content-event p{
        font-size: 17px;
        color: #3B3B3B;
        font-family: 'Modern Sans';
    }

    .content-event img{
        max-width: 70%;

        max-height: 400px;
        margin: 30px 0;
    }

    .content-promoter{
        padding: 80px 70px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .content-promoter .promoter-icon{
        width: 120px;
    }
    .description-promoter, .name-promoter{
        max-width: 500px;
        text-align: center;
    }

    .title-other-event{
        text-align: center;
        height: 50px;
    }

    .button-slader{
        background-color: white;
        border-radius: 20px;
        border: 1px solid #0070BB;
        color: #0070BB;
        margin-top: 10px;
        margin-bottom: 10px;
    }

    .button-slader:hover{
        border-color: #0070BB;
        color: white;
        background-color: #0070BB;
    }
</style>