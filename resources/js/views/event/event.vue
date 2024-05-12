<template>

    <div v-if="loading" class="grid loading d-flex justify-content-center">
        <section class="card event event-loading ml-6 mr-6 mt-3 col-12 grid">
            <div class="card">
                <div class="col-12">
                    <ProgressSpinner />
                </div>
            </div>

        </section>
    </div>
    <div v-else class="grid absolut">
        <section class="card event mt-3 col-12 grid">

            <div class="card background-image"
                :style="{ 'background-image': 'url(/images/default-background-image.png)', 'background-size': 'cover', 'border': '2px solid white' }">
            </div>
            <p class="add-event">
                {{ countParticipants }} Ins
                <button v-if="!signedUp" @click="inscribirse" class="btn btn-link add-event-button">Inscribirse</button>
                <button v-else @click="cancelar" class="btn btn-link add-event-button">Cancelar</button>
            </p>

            <div class="name-container">
                <h1 class="name-event">{{ event.name }}</h1>
                <p class="by-text">By {{ promoter.nickname }}</p>
            </div>
        </section>
    </div>
    <div class="content-event col-12">

        <p>{{ event.description }}</p>
        <!-- <img v-if="event.media[0]" :src="event.media[0].original_url" alt=""> -->
        <p>{{ event.more_information }}</p>
    </div>
    <div class="grid">
        <div class="col-0 lg:col-0 xl:col-3"></div>
        <div class="content-promoter col-12 lg:col-12 xl:col-6">
            <img v-if="profileImageUrl.value" :src="profileImageUrl.value.profile_image_url" class="profile-pic"
                alt="Profile Picture">
            <div class="container-name-promoter d-flex  justify-content-center align-items-center">
                <div class="gradient-blue gradient-promoter-right "></div>
                <h4 class="name-promoter">{{ promoter.nickname }}</h4>
                <div class="gradient-blue gradient-promoter-left"></div>
            </div>

            <p class="description-promoter">
                {{ promoter.description }}
            </p>
        </div>
        <div class="col-0 lg:col-0 xl:col-3"></div>
    </div>

    <section class="other-events col-12 mb-6">
        <div class="d-flex mt-8">
            <h4 class="title-other ml-0">You may also be interested...</h4>
            <div class="gradient-blue gradient-slader"></div>
        </div>

        <div class="slader-other d-flex justify-content-evenly grid">
            <div v-for="(evento, index) in promoterEvents.slice(-3)" :key="index"
                class="col-12 lg:col-12 xl:col-3 d-flex justify-content-center event-slader">
                <div class="card" style="width: 25rem;">
                    <img class="card-img-top" :src="getEventThumbnail(evento)" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title title-other-event">{{ evento.name }}</h5>
                        <p class="card-text">{{ sliceData(evento.description, 150) }}</p>
                    </div>
                    <router-link :to="{ name: 'publi-event.event', params: { id: evento.id } }"
                        class="button-slader btn">Ver evento...</router-link>
                </div>
            </div>
        </div>
    </section>

</template>




<script setup>
import { onMounted, onUpdated, reactive, watchEffect, ref } from "vue";
import { useRoute } from "vue-router";
import ProgressSpinner from "primevue/progressSpinner";
import useEvents from "@/composables/events";
import { useStore } from 'vuex';

const { event, events, promoter, promoterEvents, countParticipants, signedUp, getEvent, getPromoterEvent, getUsers, getCountParticipants, signedUpUser, signUser, unsignUser, deleteEvent } = useEvents()

const route = useRoute()
const store = useStore();
const aditional_image = ref('');
const user = store.state.auth.user;
let evento_id = '';
const loading = ref(true);
const profileImageUrl = reactive({ profile_image_url: null });
const thumbnail = reactive({ thumbnail: null });
onMounted(async () => {

    console.log(promoter);
    document.title = 'ConnectU - Event';
    const favicon = document.createElement('link');
    favicon.rel = 'icon';
    favicon.href = '/images/favicon-32x32.png';
    document.head.appendChild(favicon);

    evento_id = route.params.id;

    await getCountParticipants(evento_id);
    await getUsers(event.value.user_id);
    await signedUpUser(user.id, evento_id);
    await getPromoterEvent;

    loading.value = false;

    // Supongamos que event es el objeto que contiene la información del evento
    const userId = promoter.id; // Obtener el ID del creador del evento
    console.log("Promter" + userId);

    axios.get(`/api/getProfileImageUrlProfile?userId=${userId}`)
        .then(response => {
            profileImageUrl.value = response.data;
            console.log('URL de la imagen de perfil del usuario:', profileImageUrl.value);
        })
        .catch(error => {
            console.error('Error al obtener la URL de la imagen de perfil del usuario:', error);
        });


    axios.get('/api/getThumbnail')
        .then(response => {
            thumbnail.value = response.data;
            console.log('Profile image URL:', thumbnail.value);
        })
        .catch(error => {
            console.error('Error al obtener la URL de la imagen de perfil:', error);
        });

});

onUpdated(async () => {
    if (evento_id != route.params.id) {
        await getEvent(route.params.id);
    }
    await getEvent(evento_id);
    await getCountParticipants(evento_id);
    await getUsers(event.value.user_id);
    await signedUpUser(user.id, evento_id);

    loading.value = false;
});

onUpdated(async () => {
    if (evento_id != route.params.id) {
        await getEvent(route.params.id);
        await getCountParticipants(route.params.id);
        evento_id = route.params.id;
        await signedUpUser(user.id, route.params.id);
        window.scrollTo(0, 0);
    }
})

async function inscribirse() {
    try {
        await signUser(user.id, route.params.id);
        await getCountParticipants(route.params.id);
    } catch (error) {
        console.error('Error:', error.message);
    }
}

async function cancelar() {
    try {
        await unsignUser(user.id, route.params.id);
        await getCountParticipants(route.params.id);
    } catch (error) {
        console.error('Error:', error.message);
    }
}


function sliceData(text, numSlice) {
    return text.substring(0, numSlice) + " ...";
}

function getEventThumbnail(event) {
    if (event && event.media && event.media.length > 0) {
        return event.media[0].original_url;
    } else {
        return '/images/default_thumbnail.png';
    }
}


signUser
</script>

<style scoped lang="scss">
@import "../../../sass/event.scss";
</style>
