<template>
    <div class="grid">
        <div class="col-12 col-sm-12">
            <div class="card background-image" v-if="backgroundImageUrl.value"
                :style="{ 'background-image': 'url(' + backgroundImageUrl.value.background_image_url + ')', 'background-size': 'cover', 'border': '2px solid white' }">

                <div class="d-flex align-items-left">
                    <img v-if="profileImageUrl.value" :src="profileImageUrl.value.profile_image_url" class="profile-pic"
                        alt="Profile Picture">
                </div>
            </div>
        </div>
    </div>
    <div class="grid">
        <div class="col-4 col-sm-12">
            <div class="card">
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
            <div class="col-12">
                <div class="col-12">
                    <div class="card eventsRecomendations">
                        <div class="d-flex mt-8">
                            <h4 class="title-other ml-0">You may also be interested...</h4>
                            <div class="gradient-blue gradient-slader"></div>
                        </div>
                        <div v-for="event in randomEvents" :key="event.id" class="event-card">
                            <h5 class="card-title title-other-event">{{ event.name }}</h5>
                            <p class="card-text">{{ sliceData(event.description, 150) }}</p>
                            <router-link :to="{ name: 'publi-event.event', params: { id: event.id } }"
                                class="Viewmore">Ver
                                más</router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-8 col-sm-12">
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
            <input id="username" class="flex-auto" autocomplete="off" />
        </div>
        <div class="flex align-items-center gap-3 mb-2">
            <label for="email" class="font-semibold w-6rem">Email</label>
            <Input id="email" class="flex-auto" autocomplete="off" />
        </div>
        <template #footer>
            <Button label="Cancel" text severity="secondary" @click="visible = false" autofocus />
            <Button label="Save" outlined severity="secondary" @click="visible = false" autofocus />
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

import { useStore } from 'vuex';
import axios from "axios";
import { ref, inject, onMounted, computed } from "vue";

const randomEvents = ref([]);

const openEditProfileImageModal = ref(false);
const openEditBackgroundImageModal = ref(false);


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

const filters = ref({
    global: { value: null, matchMode: FilterMatchMode.CONTAINS },
});

const initFilters = () => {
    filters.value = {
        global: { value: null, matchMode: FilterMatchMode.CONTAINS },
    };
};

initFilters();

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
            console.log('Profile image URL:', profileImageUrl.value);
        })
        .catch(error => {
            console.error('Error al obtener la URL de la imagen de perfil:', error);
        });

    axios.get('/api/getBackgroundImageUrl')
        .then(response => {
            backgroundImageUrl.value = response.data;
            console.log('background image URL:', backgroundImageUrl.value);
        })
        .catch(error => {
            console.error('Error al obtener la URL de la imagen de perfil:', error);
        });
});

const store = useStore();
const user = computed(() => store.state.auth.user);

function isPromoter() {
    return user.value.NIF;
}

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
}

function sliceData(text, numSlice) {
    return text.substring(0, numSlice) + " ...";
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
    margin-top: -10px;
    color: #01afee;
    font-size: 16px;
    /* margin-left: -1rem; */
    font-family: Gotham;
}

.name {
    color: rgb(0, 0, 0);
    font-size: 22px;
    font-family: Gotham;

}



.email {
    color: rgb(34, 34, 34);
    font-size: 20px;
    margin-top: 2px;
    width: 200px;
}

.button-edit {
    top: 1rem;
    left: 32.5rem;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    margin-left: -1rem;
    margin-top: -1rem;
    color: #01afee;
    border: 1px solid #01afee;
    background-color: #ffffff;
}

.button-edit:hover {
    top: 1rem;
    left: 32.5rem;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    margin-left: -1rem;
    margin-top: -1rem;
    color: #ffffff;
    border: 1px solid #01afee;
    background-color: #01afee;
}

.card-event {
    display: flex;
}

.p-datatable {
    width: 100%;
    border: 1px solid black;
    font-family: Gotham;

}

.pi-search:before {
    margin-right: 10px;
}

.p-datatable-table {
    width: 100%;
    border: 1px solid black;
    font-family: Gotham;
}

.p-datatable-table-body {
    min-height: 100%;
}

.p-datatable-tbody>tr>td {
    text-align: left;
    border: 1px solid #dee2e6;
    border-width: 0 0 1px 0;
    padding: 1rem 1rem;
    width: 1020px;
}

.titleheader {
    font-family: Gotham;
    font-size: 22px;

}

.IconDashboard {
    padding: auto;
}

.pi:before {
    margin-left: 4px;
    --webkit-backface-visibility: hidden;
    backface-visibility: hidden;
}

.pi-user-edit:before {
    margin: auto;
    --webkit-backface-visibility: hidden;
    backface-visibility: hidden;
}

.p-button {
    margin: 10px;
}

.editprofileimage {
    width: 100px;
    height: 100px;
    object-fit: cover;
    border: 2px solid white;
}

.editButton {
    font-family: Gotham;
    font-size: 12px;
    font-weight: bold;
    color: #01afee;
    background-color: #ffffff;
    border-radius: 10px;
    border: 1px solid #01afee;
    margin-right: -20px;
    height: 30px;
    margin-top: 10px;
}

.editButton:hover {
    font-family: Gotham;
    font-size: 12px;
    font-weight: bold;
    color: #ffffff;
    background-color: #01afee;

}

.editButtons {
    display: flex;
    align-content: flex-end;
    align-items: flex-end;
    flex-direction: column;
    margin-top: -40px;

}

.custom-dialog .p-dialog-titlebar-close {
    position: absolute;
    top: 0;
    right: 0;
    margin: 0;
    padding: 0;
}

.p-dialog-header-icons {
    display: flex;
    flex-direction: row-reverse;
    justify-content: flex-start;
    align-items: flex-start;
    align-content: stretch;
}

.card.eventsRecomendations {
    margin-top: -35px;
    width: 543px;
    margin-left: -15px;
}

.card-img-top {
    width: 200px;
    height: 100px;
    display: flex;
    align-items: center;
}

.title-other {
    background-color: #0070BB;
    padding: 10px 0;
    padding-left: 20px;
    color: #fff;
    width: 400px;
    height: 45px;
    margin-top: -60px;
    margin-bottom: 10px;
}


.gradient-blue.gradient-slader {
    width: 90px;
    height: 45px;
    margin-top: -60px;
    margin-bottom: 10px;
}

.gradient-blue {
    background: linear-gradient(to bottom left, transparent 49.5%, #0070BB 49.5%, #0070BB 30%);

}

p.card-text {
    margin-bottom: 5px;
}

.ViewMore {
    color: #01afee;
    font-family: Gotham;
    margin-top: 30px;
}

.ViewMore:hover {
    color: #0070BB;
    font-family: Gotham;
    margin-top: 30px;
}

@media (max-width: 768px) {}
</style>
