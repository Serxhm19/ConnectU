<template>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between pb-2 mb-2">
                <h5 class="card-title">Añade una tarea nueva</h5>
            </div>
            <div v-if="stringSuccess" class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>{{ stringSuccess }}</strong>
            </div>


            <div v-if="stringError" class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>{{ stringError }}</strong>
            </div>
            {{ event }}
            <form @submit.prevent="addEvent">
                <div class="w-100 flex justify-content-between">
                    <div class="w-50 m-4">
                        <div class="form-group mb-2">
                            <div class="flex">
                                <h6 class="mr-1">Nombre</h6>
                                <span class="text-danger">*</span>
                            </div>
                            <div class="ml-2">
                                <input v-model="event.name" type="text" class="form-control" placeholder="Nombre tarea">
                            </div>
                        </div>

                        <div class="form-group mb-2">
                            <div class="flex">
                                <h6 class="mr-1">Categoría</h6>
                                <span class="text-danger">*</span>
                            </div>
                            <div class="ml-2">
                                <select v-model="event.category_id" class="form-control">
                                    <option value="">Selecciona una categoría</option>
                                    <option v-for="category in categories" :value="category.id">{{ category.name }}
                                    </option>
                                </select>
                            </div>
                            
                            <div class="form-gorup mb-2">
                                <div class="flex">
                                    <h6 class="mr-1">Fecha inicio</h6>
                                    <span class="text-danger">*</span>
                                </div>
                                <div class="ml-2">
                                    <input v-model="event.location" type="text" class="form-control" placeholder="Nombre tarea">
                                </div>
                            </div>

                            <div class="form-gorup mb-2">
                                <div class="flex">
                                    <h6 class="mr-1">Fecha inicio</h6>
                                    <span class="text-danger">*</span>
                                </div>
                                <div class="ml-2">
                                    <input v-model="event.start_date" class="form-control" type="datetime-local"
                                        name="start_date" />
                                </div>
                            </div>


                            <div class="form-gorup mb-2">
                                <div class="flex">
                                    <h6 class="mr-1">Fecha fin</h6>
                                    <span class="text-danger">*</span>
                                </div>
                                <div class="ml-2">
                                    <input v-model="event.end_date" class="form-control" type="datetime-local"
                                        name="end_date" />
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="w-50 m-4">
                        <div class="form-group m-2">
                            <div class="flex">
                                <h6 class="mr-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-arrow-down-square" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm8.5 2.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V4.5z" />
                                    </svg> Imagen del evento
                                </h6>
                                <span class="text-danger">*</span>
                            </div>
                            <div>
                                <DropZone class="p-5" ref="myDropzone" id="dropzone" :url="uploadUrl"
                                    @vdropzone-success="onUploadSuccess">
                                    <div class="dz-message" data-dz-message>
                                        Arrastra y suelta los archivos aquí o haz clic para seleccionar archivos
                                    </div>
                                </DropZone>
                            </div>
                            <div class="text-danger mt-1">
                                <div v-for="message in validationErrors?.thumbnail">
                                    {{ message }}
                                </div>
                            </div>
                        </div>


                    </div>
                </div>

                <div class="form-group mb-2">
                    <div class="flex">
                        <h6 class="mr-1">Descripción</h6>
                        <span class="text-danger">*</span>
                    </div>
                    <div class="ml-2">
                        <TextEditorComponent v-model="event.description" />
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-4 mb-4">Crear evento</button>
            </form>
        </div>
    </div>
</template>

<script setup>
import axios from "axios";
import { ref, inject, onMounted } from "vue"
const event = ref({});
import DropZone from "@/components/DropZone.vue";
import TextEditorComponent from "@/components/TextEditorComponent.vue";

const stringError = ref();
const stringSuccess = ref();

// Define una función para eliminar todas las etiquetas HTML del texto
function stripHtmlTags(html) {
    const doc = new DOMParser().parseFromString(html, 'text/html');
    return doc.body.textContent || "";
}

function addEvent() {
    const vuexData = localStorage.getItem("vuex");
    const vuexArray = JSON.parse(vuexData);
    const userId = vuexArray.auth.user.id;
    
    event.value.description = stripHtmlTags(event.value.description);

    const eventWithUserId = { ...event.value, user_id: Number(userId) };

    axios.post('/api/events/', eventWithUserId)
        .then(response => {
            stringSuccess.value = "Evento '" + event.value.name + "' creado correctamente";
            stringError.value = "";
            console.log(response);
        }).catch(error => {
            stringSuccess.value = "";
            stringError.value = error.response.data.message;
            console.log(error);
        });
}


const categories = ref();

onMounted(() => {
    axios.get('/api/category')
        .then(response => {
            categories.value = response.data;
            console.log(categories.value[1].id);
        })
        .catch(function (error) {
            console.log(error);
        });
});

const uploadUrl = '/upload';

const onUploadSuccess = (file, response) => {
};

function upload() {

    axios.post('/upload/', dropzone)
        .then(response => {
            console.log(response);
        }).catch(error => {
            console.log(error);
        });
}

</script>


<style></style>