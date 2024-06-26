<template>
    <div class="row">
        <div class="col-xs-12 col-sm-12">
            <div v-if="loadingImgBanner" class="background-image">
                <Skeleton width="100%" height="300px" borderRadius="10px" class="mb-0 mr-6"></Skeleton>
            </div>
            <div v-else class="card background-image" v-if="backgroundImageUrl.value"
                :style="{ 'background-image': 'url(' + backgroundImageUrl.value.background_image_url + ')', 'background-size': 'cover', 'border': '2px solid white' }">

                <div class="d-flex align-items-left">
                    <img v-if="profileImageUrl.value" :src="profileImageUrl.value.profile_image_url" class="profile-pic"
                        alt="Profile Picture">
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-4">
            <div class="card info-user">
                <div class="col-12">
                    <div>
                        <button type="button" class="btn btn-secondary button-edit pi pi-fw pi-user-edit"
                            style="font-size: 18px; display: flex; align-items: center;"
                            @click="displayEditDialog = true"></button>
                    </div>
                    <div class="editButtons">
                        <button class="editButton" @click="openEditProfileImageModal = true">
                            <i class="pi pi-pencil"></i> Profile Image
                        </button>
                        <button class="editButton" @click="openEditBackgroundImageModal = true">
                            <i class="pi pi-pencil"></i> Background Image
                        </button>
                    </div>
                </div>
                <div>
                    <div class="col-4">
                        <h2 class="name">
                            {{ user.name }} {{ user.surname }}
                        </h2>
                        <h3 class="nickname">
                            @{{ user.nickname }}
                        </h3>
                        <h2 class="email">
                            {{ user.email }}
                        </h2>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12">
                    <div class="card eventsRecomendations">
                        <div class="d-flex mt-8">
                            <h4 class="title-other ml-0">You may also be interested...</h4>
                            <div class="gradient-blue gradient-slader"></div>
                        </div>
                        <div v-if="loadingInterested" v-for="i in 3">
                            <Skeleton width="40%" height="20px" borderRadius="10px" class="mb-4 mr-6"></Skeleton>
                            <Skeleton v-for="x in 2" width="100%" height="20px" borderRadius="10px" class="mb-4 mr-6"></Skeleton>
                            <Skeleton width="50px" height="20px" borderRadius="10px" class="mb-4 mr-6"></Skeleton>
                        </div>
                        <div v-else v-for="event in randomEvents" :key="event.id" class="event-card">
                            <h5 class="card-title title-other-event">{{ event.name }}</h5>
                            <p class="card-text">{{ sliceData(event.description, 150) }}</p>
                            <router-link :to="{ name: 'publi-event.event', params: { id: event.id } }"
                                class="Viewmore">Ver más</router-link>
                        </div>
                    </div>
            </div>
        </div>

        <div class="col-xs-12 col-sm-8 view-user">
            <div v-if="isPromoter()">
                <promoterView></promoterView>
            </div>

            <div v-else>
                <userWiew></userWiew>
            </div>

        </div>
    </div>

    <Dialog v-model:visible="openEditProfileImageModal" header="Edit Profile Image" :style="{ width: '50rem' }"
        :modal="true">
        <div class="form-group">
            <label for="profile-image-input">Select new profile image</label>
            <input type="file" class="form-control" id="profilePic" name="profilePic"
                @change="updateProfileImage($event)">
        </div>
        <button type="submit" class="btn btn-primary mt-4 mb-4">Actualizar</button>
    </Dialog>

    <Dialog v-model:visible="openEditBackgroundImageModal" header="Edit Background Image" :style="{ width: '50rem' }"
        :modal="true">
        <div class="form-group">
            <label for="profile-image-input">Select new background image</label>
            <input type="file" class="form-control" id="backgroundPic" name="backgroundPic"
                @change="updateBackgroundImage($event)">
        </div>
        <button type="submit" class="btn btn-primary mt-4 mb-4">Actualizar</button>
    </Dialog>
    <Dialog v-model:visible="displayEditDialog" modal header="Edit Profile" :style="{ width: '50rem' }" :modal="true"
        class="custom-dialog">
        <span class="p-text-secondary block mb-5">Update your information.</span>
        <div class="flex align-items-center gap-3 mb-3">
            <label for="username" class="font-semibold w-6rem">Username</label>
            <input v-model="name" id="username" class="flex-auto" autocomplete="off" />
        </div>
        <div class="flex align-items-center gap-3 mb-2">
            <label for="email" class="font-semibold w-6rem">Email</label>
            <Input v-model="email" :value="email" id="email" class="flex-auto" autocomplete="off" />
        </div>
        <template #footer>
            <button type="submit" class="btn btn-primary mt-4 mb-4" @click="saveUser">Actualizar</button>
        </template>
    </Dialog>

</template>
<script setup>
import promoterView from '../account/promoter.vue';
import userWiew from '../account/user.vue';
import useEvents from "../../../composables/events";
import { reactive } from 'vue';

const profileImageUrl = reactive({ profile_image_url: null });
const backgroundImageUrl = reactive({ background_image_url: null });


import useSites from "../../../composables/sites";
const { cities, getCities } = useSites()
const { events, users, getEvents, getUsers } = useEvents();

import Button from 'primevue/button';
import { FilterMatchMode } from 'primevue/api';
import Dialog from 'primevue/dialog';
import Skeleton from "primevue/skeleton";
import { useRoute } from "vue-router";

import { useStore } from 'vuex';
import axios from "axios";
import { ref, inject, onMounted, computed } from "vue";

const randomEvents = ref([]);
const loadingInterested = ref(true);
const loadingImgBanner = ref(true);
const loadingImgProfile = ref(true);
const openEditProfileImageModal = ref(false);
const openEditBackgroundImageModal = ref(false);

const store = useStore();
const user = computed(() => store.state.auth.user);

function isPromoter() {
    return user.value.NIF;
}
const name = ref(user.value.nickname);
const email = ref(user.value.email);
const getName = (array, id) => {
    const result = array.find(object => object.id === id);
    return result ? result.name : 'Categoría no encontrada';
};

function updateProfileImage(event) {
    const thumbnailFile = event.target.files[0];
    const formData = new FormData();
    formData.append('profilePic', thumbnailFile);

    axios.post('/api/updateProfileImage', formData, {
        headers: {
            'Content-Type': 'multipart/form-data'
        }
    })
        .then(response => {
            console.log(response.data);
            openEditProfileImageModal.value = false;
            swal.fire({
                icon: 'success',
                title: '¡Actualización exitosa!',
                text: 'La imagen se ha actualizado correctamente.',
            }).then(() => {
                location.reload();
            });
        })
        .catch(error => {
            console.error(error);
            swal.fire({
                title: 'Error',
                text: 'Ocurrió un error al eliminar el evento',
                icon: 'error',
                confirmButtonText: 'Aceptar'
            });
        });
}

function updateBackgroundImage(event) {
    const file = event.target.files[0];
    const formData = new FormData();
    formData.append('backgroundImage', file);

    axios.post('/api/updateBackgroundImage', formData, {
        headers: {
            'Content-Type': 'multipart/form-data'
        }
    })
        .then(response => {
            console.log(response.data);
            openEditBackgroundImageModal.value = false;
            swal.fire({
                icon: 'success',
                title: '¡Actualización exitosa!',
                text: 'La imagen se ha actualizado correctamente.',
            }).then(() => {
                location.reload();
            });
        })
        .catch(error => {
            console.error(error);
            swal.fire({
                title: 'Error',
                text: 'Ocurrió un error al eliminar el evento',
                icon: 'error',
                confirmButtonText: 'Aceptar'
            });
        });
}


function saveUser() {
    const vuexData = localStorage.getItem("vuex");
    const vuexArray = JSON.parse(vuexData);
    const userId = vuexArray.auth.user.id;
    const route = useRoute()

    const user = computed(() => store.state.auth.user);

    const formData = new FormData();
    formData.append('id', userId);
    formData.append('name', vuexArray.auth.user.name);
    formData.append('surname', vuexArray.auth.user.surname);
    formData.append('nickname', name.value);
    formData.append('email', email.value);
    formData.append('genre', vuexArray.auth.user.genre);
    formData.append('nif', vuexArray.auth.user.nif);
    formData.append('description', vuexArray.auth.user.description);
    formData.append('category_id', vuexArray.auth.user.category_id);

    axios.put(`/api/users/${userId}`, formData, {
        headers: {
            'Content-Type': 'multipart/form-data'
        }
    })
    .then(response => {
            console.log(response.data);
            swal.fire({
                icon: 'success',
                title: '¡Actualización exitosa!',
                text: 'Los datos del usuario se han actualizado correctamente.',
            }).then(() => {
                // Realizar alguna acción adicional si es necesario
            });
        })
        .catch(error => {
            console.error(error);
            swal.fire({
                title: 'Error',
                text: 'Ocurrió un error al actualizar los datos del usuario',
                icon: 'error',
                confirmButtonText: 'Aceptar'
            });
        });
}


onMounted(async () => {
    await getEvents();
    await getUsers();
    generateRandomEvents();
    await getCities()

    const vuexData = localStorage.getItem("vuex");
    const vuexArray = JSON.parse(vuexData);
    let id = vuexArray.auth.user.id;

    document.title = 'ConnectU - Account';
    const favicon = document.createElement('link');
    favicon.rel = 'icon';
    favicon.href = '/images/favicon-32x32.png';
    document.head.appendChild(favicon);


    axios.get('/api/events/promoter/' + id)
        .then(response => {
            events.value = response.data;

            events.value.forEach(event => {
                const cityId = event.location;
                const cityName = getName(cities.value, cityId);
                event.location = cityName;
            });
        });

    axios.get('/api/getProfileImageUrl')
        .then(response => {
            profileImageUrl.value = response.data;
            loadingImgProfile.value = false;
        })
        .catch(error => {
            console.error('Error al obtener la URL de la imagen de perfil:', error);
        });

    axios.get('/api/getBackgroundImageUrl')
        .then(response => {
            backgroundImageUrl.value = response.data;
            loadingImgBanner.value = false;
        })
        .catch(error => {
            console.error('Error al obtener la URL de la imagen de perfil:', error);
        });
});



const swal = inject('$swal');

onMounted(() => {
    const vuexData = localStorage.getItem("vuex");
    const vuexArray = JSON.parse(vuexData);
    let id = vuexArray.auth.user.id;

    axios.get('/api/events/promoter/' + id)
        .then(response => {
            events.value = response.data;
        })
});

const displayEditDialog = ref(false);

function generateRandomEvents() {
    const eventCount = events.value.length;
    const randomIndices = [];
    while (randomIndices.length < 3) {
        const randomIndex = Math.floor(Math.random() * eventCount);
        if (!randomIndices.includes(randomIndex)) {
            randomIndices.push(randomIndex);
        }
    }
    randomEvents.value = randomIndices.map(index => events.value[index]);
    loadingInterested.value = false;
}

function sliceData(text, numSlice) {
    return text.substring(0, numSlice) + " ...";
}
</script>
<style scoped lang="scss">
@import "../../../../sass/account.scss";



</style>
