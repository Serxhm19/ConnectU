<template>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-right pb-2 mb-2">
                <h5 class="card-title">Edición de el evento <b>{{event.name}}</b></h5>
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
                    <textarea class="form-control" rows="3" v-model="event.description" placeholder="Descripción"></textarea>
                </div>


                <div class="form-gorup mb-2">
                    <label>Fecha inicio</label><span class="text-danger">*</span>
                    <input class="form-control" type="datetime-local" v-model="event.start_date" name="start_date" />
                </div>
       
                <div class="form-gorup mb-2">
                    <label>Fecha fin</label><span class="text-danger">*</span>
                    <input class="form-control" type="datetime-local" v-model="event.end_date" name="end_date" />
                </div>


                <button type="submit" class="btn btn-primary mt-4 mb-4">Guardar evento</button>


            </form>


        </div>
    </div>
</template> 


<script setup>

import { ref, onMounted, reactive } from "vue";
import { useForm, useField} from "vee-validate";
import { useRoute } from "vue-router";
import * as yup from 'yup';
import { es } from 'yup-locales';
import { setLocale } from 'yup';


const schema =  yup.object({
    name: yup.string().required().label('Nombre'),
})


const { validate, errors } = useForm({ validationSchema: schema })
const route = useRoute()

console.log(route.params.id);
setLocale(es);




const { value: name } = useField('name', null, { initialValue: '' });
const { value: description } = useField('description', null, { initialValue: '' });
const { value: start_date } = useField('start_date', null, { initialValue: '' });
const { value: end_date } = useField('end_date', null, { initialValue: '' });


const event = reactive({
    name,
    description,
    start_date,
    end_date
})


const strSuccess = ref();
const strError = ref();


onMounted(() => {
    axios.get('/api/events/show/' + route.params.id)
    .then(response => {
        event.name = response.data.name;
        event.description = response.data.description;
        event.start_date = response.data.start_date;
        event.end_date = response.data.end_date;
    })
    .catch(function(error) {
        console.log(error);
    });
})


function saveEvent() {
    validate().then(form => {
        console.log('validate');
        if (form.valid){
            axios.put('/api/events/update/'+route.params.id, event)
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


<style>
</style>