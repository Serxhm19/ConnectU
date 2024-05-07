<template>
    <div class="card">
                <DataTable class="p-datatable" :value="events" paginator :rows="10" filterDisplay="row"
                    :filters="filters">
                    <template #header>
                        <div class="flex justify-content-end">
                            <h2 style="margin-right: auto;">Event Dashboard</h2>
                            <IconField iconPosition="left">
                                <InputIcon>
                                    <i class="pi pi-search"></i>
                                </InputIcon>
                                <InputText v-model="filters['global'].value" placeholder="Keyword Search" />
                            </IconField>
                        </div>
                    </template>
                    <template #empty class="empty">
                        No events found.
                    </template>
                    <template #loading> Loading events data. Please wait. </template>
                    <Column field="name" header="Name"></Column>
                    <Column field="location" header="Location"></Column>
                    <Column field="start_date" header="Start Date">
                        <template v-slot:body="slotProps">
                            {{ formatDate(slotProps.data.start_date) }}
                        </template>
                    </Column>
                    <Column field="end_date" header="End Date">
                        <template v-slot:body="slotProps">
                            {{ formatDate(slotProps.data.end_date) }}
                        </template>
                    </Column>
                    <Column field="status" header="Status">
                        <template v-slot:body="slotProps">
                            <span v-if="isEventExpired(slotProps.data.end_date)">
                                <Tag severity="danger" value="Expired"></Tag>
                            </span>
                            <span v-else>
                                <Tag severity="success" value="Success"></Tag>
                            </span>
                        </template>
                    </Column>
                    <Column header="Actions" >
                        <template v-slot:body="slotProps">
                            <router-link :to="{ name: 'events.update', params: { id: slotProps.data.id } }">
                                <Button icon="pi pi-pencil" severity="help" text raised rounded>
                                    <template #icon>
                                        <i class="pi pi-pencil"></i>
                                    </template>
                                </Button> </router-link>
                            <Button iconClass="my-custom-icon-class" icon="pi pi-trash" severity="danger" text raised
                                rounded @click="deleteTask(slotProps.data.id)">
                                <template #icon>
                                    <i class="pi pi-trash"></i>
                                </template>
                            </Button>
                        </template>
                    </Column>
                </DataTable>
                
            </div>
</template>

<script setup>
import promoter from '../account/promoter.vue';


import Tag from 'primevue/tag';
import InputText from 'primevue/inputtext'
import Button from 'primevue/button';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import InputIcon from 'primevue/inputicon';
import IconField from 'primevue/iconfield';
import Dialog from 'primevue/dialog';
import Avatar from 'primevue/avatar';
import { useStore } from 'vuex';
import axios from "axios";
import { ref, inject, onMounted, computed } from "vue"
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

        })
});

const store = useStore();
const user = computed(() => store.state.auth.user)
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