<template>
    <div class="grid">
        <div class="col-12">
            <div class="card background-image"
                style="background-image: url('/images/logo.png'); background-size: cover; border: 2px solid white;">
                <div class="card-body">
                    <div class="d-flex justify-content-between pb-2 mb-4">
                    </div>
                </div>
                <div class="d-flex align-items-left">
                    <img :src="profileImageUrl" class="profile-pic" alt="Profile Picture">
                </div>
            </div>
        </div>
    </div>

    <div class="grid">
        <div class="col-4">
            <div class="card">
                <div class="col-12">
                    <div>
                        <button type="button" class="btn btn-secondary button-edit pi pi-fw pi-user-edit"
                            @click="displayEditDialog = true"></button>
                    </div>
                    <div class="flex align-items-center gap-3 mb-2">
                        <button type="button" class="btn btn-secondary" @click="openEditProfileImageModal = true">Edit
                            Profile Image</button>
                        <button type="button" class="btn btn-secondary"
                            @click="openEditBackgroundImageModal = true">Edit Background
                            Image</button>
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
                    <h2>Te podria interesar</h2>
                    <div v-for="event in Events" :key="event.id" class="event-card">
                        <h3>{{ event.name }}</h3>
                        <p>{{ event.location }}</p>
                        <router-link :to="{ name: 'publi-event.event', params: { id: event.id } }">Ver más</router-link>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-8">
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
            <input type="file" class="form-control" id="profilePic" name="profilePic" @change="updateProfileImage($event)">
        </div>
        <button type="submit" class="btn btn-primary mt-4 mb-4">Actualizar</button>

    </Dialog>

    <Dialog v-model:visible="openEditBackgroundImageModal" modal header="Edit Background Image"
        :style="{ width: '50rem' }" :modal="true">
        <input type="file" id="background-image-input" @change="updateBackgroundImage">
        <label for="background-image-input">Select new background image</label>
    </Dialog>
    <Dialog v-model:visible="displayEditDialog" modal header="Edit Profile" :style="{ width: '50rem' }" :modal="true">
        <span class="p-text-secondary block mb-5">Update your information.</span>
        <div class="flex align-items-center gap-3 mb-3">
            <label for="username" class="font-semibold w-6rem">Username</label>
            <InputText id="username" class="flex-auto" autocomplete="off" />
        </div>
        <div class="flex align-items-center gap-3 mb-2">
            <label for="email" class="font-semibold w-6rem">Email</label>
            <InputText id="email" class="flex-auto" autocomplete="off" />
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

const { events, users, getEvents, getUsers } = useEvents();
const profileImageUrl = ref(null); // Changed to ref

import Button from 'primevue/button';
import { FilterMatchMode } from 'primevue/api';
import Dialog from 'primevue/dialog';

import { useStore } from 'vuex';
import axios from "axios";
import { ref, inject, onMounted, computed } from "vue";

const openEditProfileImageModal = ref(false);
function openEditProfileImage() {
    openEditProfileImageModal.value = true;
}
const openEditBackgroundImageModal = ref(false);
function openEditBackgroundImage() {
    openEditBackgroundImageModal.value = true;
}

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
    })
    .catch(error => {
        console.error(error);
    });
}

function updateBackgroundImage(event) {
    const file = event.target.files[0];
    // Upload the file to your server or update the background image URL
    console.log(file);
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

    const vuexData = localStorage.getItem("vuex");
    const vuexArray = JSON.parse(vuexData);
    let id = vuexArray.auth.user.id;

    axios.get('/api/events/promoter/' + id)
        .then(response => {
            events.value = response.data;
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

.background-image {
    margin-top: -55px
}
</style>

