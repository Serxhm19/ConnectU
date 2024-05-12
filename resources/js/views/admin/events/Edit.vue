<template>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-right pb-2 mb-2">
                <h5 class="card-title">Edición del evento <b>{{ event.name }}</b></h5>
            </div>


            <div v-if="strSuccess" class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>{{ strSuccess }}</strong>
            </div>


            <div v-if="strError" class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>{{ strError }}</strong>
            </div>


            <form @submit.prevent="saveEvent">


                <div class="form-group mb-2">
                    <label>Nombre</label><span class="text-danger"> *</span>
                    <input type="text" class="form-control" v-model="event.name" placeholder="Nombre tarea">
                    <div class="text-danger mt-1">
                        {{ errors.name }}
                    </div>
                </div>


                <div class="form-group mb-2">
                    <label>Descripción</label><span class="text-danger"> *</span>
                    <textarea class="form-control" rows="3" v-model="event.description"
                        placeholder="Descripción"></textarea>
                </div>
                <div class="ml-2">
                    <select v-model="event.category_id" class="form-control">
                        <option selected :value="event.category_id">{{ event.category_id }}</option>
                        <option v-for="category in categories" :value="category.id">{{ category.name }}</option>
                    </select>
                </div>
                <div class="form-gorup mb-2">
                    <div class="flex">
                        <h6 class="mr-1">Location</h6>
                        <span class="text-danger">*</span>
                    </div>
                    <div class="ml-2">
                        <input v-model="event.location" type="text" class="form-control" placeholder="Location">
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
                        <div class="form-group">
                            <label for="thumbnail">Thumbnail</label>
                            <input type="file" class="form-control" id="thumbnail" name="thumbnail">
                        </div>
                        <div class="text-danger mt-1">
                            <div v-for="message in validationErrors?.thumbnail">
                                {{ message }}
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
                                </svg> Imagen adicional del evento
                            </h6>
                            <span class="text-danger">*</span>
                        </div>
                        <div class="form-group">
                            <label for="additional_image">Thumbnail</label>
                            <input type="file" class="form-control" id="additional_image" name="additional_image">
                        </div>
                    </div>
                </div>

                <div class="form-gorup mb-2">
                    <label>Fecha inicio</label><span class="text-danger">*</span>
                    <input class="form-control" type="datetime-local" v-model="event.start_date" name="start_date" />
                </div>

                <div class="form-gorup mb-2">
                    <label>Fecha fin</label><span class="text-danger">*</span>
                    <input class="form-control" type="datetime-local" v-model="event.end_date" name="end_date" />
                </div>
                <div class="form-group mb-2">
                    <div class="flex">
                        <h6 class="mr-1">Información adicional sobre tu evento</h6>
                        <span class="text-danger">*</span>
                    </div>
                    <div class="ml-2">
                        <TextEditorComponent v-model="event.more_information" />
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-4 mb-4">Guardar evento</button>
            </form>
        </div>
    </div>
</template>


<script setup>

import { ref, onMounted, reactive } from "vue";
import { useForm, useField } from "vee-validate";
import { useRoute } from "vue-router";
import * as yup from 'yup';
import { es } from 'yup-locales';
import { setLocale } from 'yup';
import TextEditorComponent from "@/components/TextEditorComponent.vue";


const schema = yup.object({
    name: yup.string().required().label('Nombre'),
})


const { validate, errors } = useForm({ validationSchema: schema })
const route = useRoute()

setLocale(es);




const { value: name } = useField('name', null, { initialValue: '' });
const { value: description } = useField('description', null, { initialValue: '' });
const { value: start_date } = useField('start_date', null, { initialValue: '' });
const { value: end_date } = useField('end_date', null, { initialValue: '' });


const event = reactive({
    user_id: '',
    name,
    description,
    start_date,
    end_date,
    thumbnail: ''
})


const strSuccess = ref();
const strError = ref();

const categories = ref();
onMounted(() => {

    document.title = 'ConnectU - Edit Event';
    const favicon = document.createElement('link');
    favicon.rel = 'icon';
    favicon.href = '/images/favicon-32x32.png';
    document.head.appendChild(favicon);

    axios.get('/api/events/show/' + route.params.id)
        .then(response => {
            event.user_id = response.data.user_id;
            event.name = response.data.name;
            event.description = response.data.description;
            event.start_date = response.data.start_date;
            event.end_date = response.data.end_date;
        })
        .catch(function (error) {
            console.log(error);
        });

    axios.get('/api/category')
        .then(response => {
            categories.value = response.data;
        })
        .catch(function (error) {
            console.log(error);
        });
})

function saveEvent() {
    const vuexData = localStorage.getItem("vuex");
    const vuexArray = JSON.parse(vuexData);
    const userId = vuexArray.auth.user.id;

    validate().then(form => {
        if (form.valid) {
            const formData = new FormData();
            formData.append('name', event.name); // Accede a 'name' directamente desde 'event'
            formData.append('category_id', event.category_id);
            formData.append('description', event.description);
            formData.append('more_information', event.more_information);
            formData.append('location', event.location);
            formData.append('start_date', event.start_date);
            formData.append('end_date', event.end_date);
            formData.append('user_id', userId);

            const thumbnailFile = document.getElementById('thumbnail').files[0];
            formData.append('thumbnail', thumbnailFile);

            const additionalThumbnailFile = document.getElementById('additional_image').files[0];
            formData.append('additional_image', additionalThumbnailFile);
            // Envía el formData al servidor
            axios.post('/api/events/update/' + route.params.id, formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
                .then(response => {
                    strError.value = ""
                    strSuccess.value = response.data.success
                })
                .catch(function (error) {
                    strSuccess.value = ""
                    strError.value = error.response.data.message
                });
        }
    })
}



</script>


<style></style>