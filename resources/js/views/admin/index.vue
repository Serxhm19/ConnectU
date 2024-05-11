<template>
    <div class="grid">
        <div class="col-12 lg:col-3 xl:col-3">
            <div class="card-body content-chats-view gotham">
                <div class="card mb-4">
                    <div class="card-body chats">
                        <h3 class="mb-1 mt-1 text-center">My events</h3>
                        <hr>
                        <div class="list-group">
                            <div class="list-group-item list-group-chat">
                                <div v-if="isLoadingUserEvents || true" v-for="x in 3">
                                    <div class="flex mb-3">
                                        <Skeleton shape="circle" size="4rem" class="mr-2" borderRadius="50px"></Skeleton>
                                        <div>
                                            <Skeleton width="10rem" class="mb-2"></Skeleton>
                                            <Skeleton width="5rem" class="mb-2"></Skeleton>
                                            <Skeleton height=".5rem"></Skeleton>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                                <div v-else v-for="event in events_user" :key="event.id">
                                    <div class="d-flex justify-content-between mb-1">
                                        <div style="display: flex;">
                                            <img src="\images\eventoPrueba.webp" alt=""
                                                style="height: 30px; width: 30px; border-radius: 30px;">
                                            <h6 class="ml-3 mb-1 mt-1 text-left">{{ sliceData(event.name) }}</h6>
                                        </div>
                                    </div>
                                    <div class="d-flex w-100 justify-content-center">
                                        <p class="mb-1 mt-1 text-center" style="color: #6A6A6A; font-size: 13px;">{{
                                    formatDate(event.start_date) }} - {{ formatDate(event.end_date) }}</p>
                                    </div>
                                    <hr>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>  
        </div>
        <div class="col-12 lg:col-6 xl:col-6 gotham content-events">
            <div v-if="isLoadingEvents">
                <div v-for="i in 2" class="card pl-0 pr-0 pt-3">
                    <div class="d-flex justify-content-between">
                        <Skeleton width="200px" height="20px" borderRadius="10px" class="mb-3 ml-4"></Skeleton>
                        <Skeleton width="150px" height="20px" borderRadius="10px" class="mb-3 mr-4"></Skeleton>
                    </div>
                    <Skeleton width="100%" height="400px" borderRadius="0px" class="mb-4"></Skeleton>
                    <div class="d-flex justify-content-between mb-5">
                        <Skeleton width="200px" height="20px" borderRadius="10px" class="ml-4"></Skeleton>
                        <Skeleton width="150px" height="20px" borderRadius="10px" class="mr-4"></Skeleton>
                    </div>
                    <div class="d-flex justify-content-between mb-5">
                        <Skeleton width="100%" height="100px" borderRadius="10px" class="ml-6 mr-6"></Skeleton>
                    </div>
                    <div class="d-flex justify-content-between">
                        <Skeleton width="30%" height="15px" borderRadius="10px" class="mb-3 ml-6 mr-6"></Skeleton>
                        <Skeleton width="20%" height="15px" borderRadius="10px" class="mb-3 ml-6 mr-6"></Skeleton>
                    </div>
                </div>
            </div>
            <div v-else style="border-radius: 40px;">
                <div v-for="event in events" :key="event.id" class="card event-home" style="border-radius: 20px;">
                    <div class="card-body" style="padding: 8px 14px;">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">{{ event.name }}</h5>
                            <p class="mb-1">{{ getName(cities, event.location) }}</p>
                        </div>
                    </div>
                    <img class="card-img-top" src="\images\eventoPrueba.webp" alt="Card image cap"
                        style="height: 350px; border-radius: 0;">
                    <div class="card-body">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">{{ getUserName(event.user_id) }}</h5>
                            <p class="mb-1" style="color: grey">{{ formatDate(event.start_date) }} - {{
                                    formatDate(event.end_date) }}</p>
                        </div>
                        <div class="d-flex justify-content-center" style="margin: 20px 30px;">
                            <p style="text-align: justify;">
                                {{ sliceDataDescription(event.description) }}
                            </p>
                        </div>
                        <div class="d-flex justify-content-between" style="margin: 20px 30px;">
                            <span style="color: #00AAC4">
                                #{{ getCategoryName(event.category_id) }}
                            </span>
                            <router-link :to="{ name: 'publi-event.event', params: { id: event.id } }"
                                class="btn btn-link mr-3">Ver más...</router-link>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-12 lg:col-3 xl:col-3 gotham">
            <div class="fixed filters">
                <div class="searchLabel">
                    <IconField iconPosition="left">
                        <InputIcon class="pi pi-search"> </InputIcon>
                        <InputText v-model="search_global" placeholder="Search" />
                    </IconField>
                </div>
                <div class="card filters-container">
                    <div class="title-filter">
                        <h5>Ubicación del evento</h5>
                    </div>

                    <select class="select-ubi" id="province-selector">
                        <option value="" selected>Provincia</option>
                        <option v-for="province in provinces" :value="province.id">{{ province.name }}</option>
                    </select>

                    <select class="select-ubi" id="city-selector" v-model="search_location">
                        <option value="" selected>Ciudad</option>
                        <option v-for="city in cities" :value="city.id">{{ city.name }}</option>
                    </select>
                </div>
                <div class="card filters-container">
                    <div class="title-filter">
                        <h5>Fecha del evento</h5>
                    </div>
                    <div class="filter-date">
                        <div class="form-date">
                            <input v-model="search_start_date" class="form-date__input" type="date"
                                id="start_date_input" name="input-date-start">
                        </div>

                        <div class="form-date">
                            <input v-model="search_end_date" class="form-date__input" type="date" id="end_date_input"
                                name="input-date-start">
                        </div>
                    </div>
                </div>

                <div class="card filter-categories">
                    <div class="title-filter">
                        <h5>Categorías más buscadas</h5>
                    </div>
                    <div class="buttons-categories d-flex">
                        <div>
                            <div v-for="(category, index) in categories.slice(0, 5)" :key="index">
                                <p class="category-p">#{{ category.name }}</p>
                            </div>
                        </div>
                        <div>
                            <div v-for="(category, index) in categories.slice(5, 10)" :key="index">
                                <p class="category-p">#{{ category.name }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style scoped>
.content-events {
    margin-top: 0rem;
}

.gotham {
    font-family: Gotham;
}

.list-group-chat {
    border: 0;
}

.content-chats-view {
    position: fixed;
    top: 7.5rem;
    left: 20px;
    z-index: 997;
    width: 23%;
}

@media (max-width: 768px) {
    .content-chats-view {
        display: none;
    }

    .content-events {
        padding-left: 20px;
        padding-right: 20px;
        margin-top: 80px;
    }

}

.chats hr {
    border: 1px solid black;
}

.event-home {
    padding: 0;
}

.event-home img {
    width: 100%;
    height: 200px;

}




/* FILTER CSS */
.filters {
    width: 24%;
    max-height: 708px;
    overflow: auto;
}

.title-filter {
    font-size: 20px;
    text-align: center;
}

/*SEARCH LABEL CSS */
.searchLabel {
    background-color: white;
    border-radius: 20px;
    margin-bottom: 20px;
    border: 1px solid black;
}

.searchLabel span {
    padding: 0 15px;
    border-right: 1px solid black;
}

input.p-inputtext {
    width: 87%;
    border-radius: 0 20px 20px 0;
    border: 0;
}

input.p-inputtext:focus {
    border: 0;
}


/*FILTER LOCATION CSS */
.filters-container {
    padding: 15px;
    display: flex;
    flex-direction: column;
    justify-content: space-around;
    align-items: center;
    height: auto;
    margin-bottom: 1rem;
}

.p-tree-wrapper ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
}

.select-ubi {
    border-radius: 20px;
    margin-top: 15px;
    text-align: center;
    border: 1px solid black;
    width: 220px;
}

/* FILTER DATE CSS */
.filter-date {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-content: center;
    width: 60%;
}

.form-date {
    padding: 16px;
    display: flex;
    flex-direction: column;
}

.form-date__input[type='date'] {
    appearance: none;
    color: #1D1D1D;
    text-align: center;
    font-size: 16px;
    border: 1px solid #838383;
    background: #ffffff;
    padding: 4px;
    display: inline-block;
    visibility: visible;
    width: 100%;
    border-radius: 20px;
}

.form-date__input[type='date']:focus {
    color: #0070BB;
    background-color: #FFFFFF;
    border-color: #80BDFF;
    outline: 0;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, .25);
}

/* FILTER CATEGORIES CSS */
.buttons-categories div {
    padding: 0;
}

.buttons-categories div p {
    color: #5D9EFF;
    width: auto;
    text-align: center;
    cursor: pointer;
}

.category-p {
    margin: 5px;
    transition: 0.5s;
}

.category-p:hover {
    color: #003262;
}

.category-p.selected {
    background-color: #0070BB;
    color: #fff;
    border-radius: 20px;
    padding: 0 1.5px;
}
</style>
<script setup>
import { useAbility } from '@casl/vue';
import { ref, onMounted, watch } from "vue";

import useCategories from "../../composables/categories_event";
import useEvents from "../../composables/events";
import useSites from "../../composables/sites";

import IconField from "primevue/iconField";
import InputIcon from "primevue/inputIcon";
import InputText from "primevue/inputText";
import Skeleton from "primevue/skeleton";

const { categories, getCategories, deleteCategory } = useCategories()
const { isLoadingEvents, isLoadingUserEvents, events, users, events_user, getEvents, getEventsFilter, getUsers, getEventsUser } = useEvents()
const { cities, provinces, getCities, getProvinces, getCitiesByProvince } = useSites()

const search_global = ref('')
const search_category = ref('')
const search_id = ref('')
const search_name = ref('')
const search_description = ref('')
const search_location = ref('')
const search_start_date = ref('')
const search_end_date = ref('')
const search_user_id = ref('')
const orderColumn = ref('created_at')
const orderDirection = ref('desc')

onMounted(async () => {

    document.title = 'ConnectU - Home';
    const favicon = document.createElement('link');
    favicon.rel = 'icon';
    favicon.href = '/images/favicon-32x32.png';
    document.head.appendChild(favicon);

    await getCategories()
    await getCities()
    await getProvinces()
    await getUsers()
    await getEvents()
    await getEventsUser(1)
    console.log('events user: ');
    console.log(events_user.value)
    changeNameLocationEvent()

    watch([search_global, search_category, search_id, search_name, search_description, search_location, search_start_date, search_end_date, search_user_id, orderColumn, orderDirection], () => {
        isLoadingEvents.value = true;
        filterEvents()
        changeNameLocationEvent()

    });

    const categoryP = document.getElementsByClassName('category-p');
    const categoryArray = Array.from(categoryP);

    categoryArray.forEach(categoryFilter => {
        categoryFilter.addEventListener('click', async () => {
            const categoryName = categoryFilter.innerHTML.substring(1);
            const categoryId = categories.value.find(category => category.name === categoryName)?.id;

            if (categoryFilter.classList.contains('selected')) {
                categoryFilter.classList.remove('selected');

                search_category.value = '';
            } else {
                categoryArray.forEach(element => {
                    element.classList.remove('selected');
                });

                categoryFilter.classList.add('selected');
                search_category.value = categories.value.find(cat => cat.name === categoryName).id
            }
        });
    });
})

watch([search_global, search_category, search_id, search_name, search_description, search_location, search_start_date, search_end_date, search_user_id, orderColumn, orderDirection], () => {
    filterEvents()
    changeNameLocationEvent()
});

function getCategoryName(categoryId) {
    const category = categories.value.find(cat => cat.id === categoryId);
    return category ? category.name : 'Uncategorized';
}

function getUserName(id) {
    const user = users.value.find(userValue => userValue.id === id);
    return user ? user.nickname : 'null';
}

function sliceDataDescription(text) {
    return text.substring(0, 300) + "...";
}

function formatDate(dateString) {
    const date = new Date(dateString);
    const options = { day: '2-digit', month: '2-digit', year: 'numeric' };
    return date.toLocaleDateString('es-ES', options);
}

function sliceData(text) {
    return text.substring(0, 25) + "...";
}

const getName = (array, id) => {
    const result = array.find(object => object.id === id);
    return result ? result.name : 'Categoría no encontrada';
};

async function filterEvents() {
    await getEventsFilter(1, search_global.value, search_category.value, search_id.value, search_name.value, search_description.value, search_location.value, search_start_date.value, search_end_date.value, search_user_id.value, orderColumn.value, orderDirection.value)
}

function changeNameLocationEvent() {
    /*events.forEach(evento => {
        const city = cities.find(c => c.id === evento.location);
        if (city) {
            evento.location = city.name; // Añadir una nueva propiedad category_name al evento con el nombre de la categoría
        }
    });
    */
}

</script>