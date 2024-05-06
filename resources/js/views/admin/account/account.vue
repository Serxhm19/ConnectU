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
                        <button type="button" class="btn btn-secondary button-edit pi pi-fw pi-user-edit"
                            @click="displayEditDialog = true"></button>
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
            <div v-if="isPromoter()">
                <promoterView></promoterView>
            </div>

            <div v-else>
                <userWiew></userWiew>
            </div>
            
        </div>
    </div>
    <div class="card flex">
        <Dialog v-model:visible="displayEditDialog" modal header="Edit Profile" :style="{ width: '50rem' }"
            :modal="true">
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
    </div>
</template>
<script setup>
import promoterView from '../account/promoter.vue';
import userWiew from '../account/user.vue';


import InputText from 'primevue/inputtext';
import Button from 'primevue/button';

import Dialog from 'primevue/dialog';
import { useStore } from 'vuex';
import axios from "axios";
import { ref, inject, onMounted, computed } from "vue";
import { FilterMatchMode } from 'primevue/api';

const filters = ref({
    global: { value: null, matchMode: FilterMatchMode.CONTAINS },
});

const initFilters = () => {
    filters.value = {
        global: { value: null, matchMode: FilterMatchMode.CONTAINS },
    };
};



initFilters();

onMounted(() => {
    // console.log('mi vista')
    const vuexData = localStorage.getItem("vuex");
    const vuexArray = JSON.parse(vuexData);
    let id = vuexArray.auth.user.id;

    axios.get('/api/events/promoter/' + id)
        .then(response => {
            events.value = response.data;

            console.log(events.value);

            events.value.forEach(event => {
                event.description = stripHtmlTags(event.description);
            });

        })
});

const store = useStore();
const user = computed(() => store.state.auth.user);

function isPromoter() {
    return user.value.NIF;
}

const events = ref([]);
const swal = inject('$swal');

onMounted(() => {
    // console.log('mi vista')
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

function formatDate(dateString) {
    const date = new Date(dateString);
    const options = { day: '2-digit', month: '2-digit', year: 'numeric' };
    return date.toLocaleDateString('es-ES', options);
}

function isEventExpired(endDate) {
    const currentDate = new Date();
    const eventEndDate = new Date(endDate);

    return eventEndDate < currentDate;
}


const displayEditDialog = ref(false);
const editedUser = ref({
    // Inicialice editedUser con los datos del usuario actual
});

const saveEditedUser = () => {
    // Guarde los datos del usuario editado en la tienda o envíelos al servidor
    displayEditDialog.value = false;
};

//function stripHtmlTags(html) {
//  const doc = new DOMParser().parseFromString(html, 'text/html');
//return doc.body.textContent || "";
//}

//events.value.forEach(event => {
//  event.description = stripHtmlTags(event.description);
//});

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
</style>