<template>
    <div class="grid">
        <div class="col-12 lg:col-3 xl:col-3">
            <div class="card-body content-events-user gotham">
                <!-- Botón para mostrar apartado de mis eventos -->
                <button v-if="screenWidth <= 500" @click="showEvents = !showEvents"
                    class="button-view-events btn btn-primary">
                    {{ showEvents ? 'Ocultar eventos' : 'Mis eventos' }}
                </button>

                <!-- apartado de eventos -->
                <div class="card mb-4 container-my-events" v-if="showEvents || screenWidth > 500">
                    <div class="card-body chats">
                        <h3 class="mb-1 mt-1 text-center">My events</h3>
                        <hr>
                        <div class="list-group">
                            <div class="list-group-item list-group-chat">
                                <div v-if="isLoadingUserEvents" v-for="x in 3">
                                    <div class="flex mb-3">
                                        <Skeleton shape="circle" size="4rem" class="mr-2" borderRadius="50px">
                                        </Skeleton>
                                        <div>
                                            <Skeleton width="10rem" class="mb-2"></Skeleton>
                                            <Skeleton width="5rem" class="mb-2"></Skeleton>
                                            <Skeleton height=".5rem"></Skeleton>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                                <div v-else v-for="event in events_user" :key="event.id">
                                    <router-link :to="{ name: 'publi-event.event', params: { id: event.id } }">
                                        <div class="d-flex justify-content-between mb-1 w-100">
                                            <div style="display: flex; width: 100%;">
                                                <img :src="getEventThumbnail(event)" alt=""
                                                    style="height: 30px; width: 30px; border-radius: 30px;">
                                                <div style="width: 100%;">
                                                    <h6 class="ml-3 mb-1 mt-1 text-left">{{ event.name }}</h6>
                                                    <p class="mb-1 mt-1 text-center"
                                                        style="color: #6A6A6A; font-size: 13px;">
                                                        {{ formatDate(event.start_date) }} - {{
                    formatDate(event.end_date) }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </router-link>
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
                        <div class="event-header d-flex w-100 justify-content-between">
                            <h5 class="mb-1">{{ event.name }}</h5>
                            <p class="mb-1">{{ getName(cities, event.location) }}</p>
                        </div>
                    </div>
                    <img class="card-img-top" :src="getEventThumbnail(event)" alt="Card image cap"
                        style="height: 350px; border-radius: 0;">
                    <div class="card-body">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">{{ getUserName(event.user_id) }}</h5>
                            <p class="mb-1" style="color: grey">
                                {{ formatDate(event.start_date) }}
                                -
                                {{ formatDate(event.end_date) }}
                            </p>
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
        <div class="col-filters col-12 lg:col-3 xl:col-3 gotham">
            <!-- Botón para mostrar apartado de filtros -->
            <button v-if="screenWidth <= 500" @click="showFilters = !showFilters"
                class="button-view-filters btn btn-primary">
                {{ showFilters ? 'Ocultar filtros' : 'Filtrar' }}
            </button>

            <div class="fixed filters" v-if="showFilters || screenWidth > 500">
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

                    <select class="select-ubi" id="city-selector" v-model="search_location">
                        <option value="" selected>Ciudad</option>
                        <AutoComplete v-model="value" :suggestions="items" @complete="search" />
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
                    <div v-if="!loadingCategories" class="buttons-categories d-flex">
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
                    <div v-else class="buttons-categories">
                        <div>
                            <div v-for="x in 5">
                                <Skeleton width="100%" height="20px" borderRadius="10px" class="mb-4"></Skeleton>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style scoped lang="scss">
@import "../../../sass/home.scss";



</style>
<script setup>
import { useAbility } from '@casl/vue';
import { ref, onMounted, watch, computed } from "vue";
import { useStore } from 'vuex';

import useCategories from "../../composables/categories_event";
import useEvents from "../../composables/events";
import useSites from "../../composables/sites";

import IconField from "primevue/iconField";
import InputIcon from "primevue/inputIcon";
import InputText from "primevue/inputText";
import Skeleton from "primevue/skeleton";
import AutoComplete from "primevue/autocomplete";

const { loadingCategories, categories, getCategories, deleteCategory } = useCategories()
const { bannerEvent, isLoadingEvents, isLoadingUserEvents, events, users, events_user, getEvents, getUrlBannerEvent, getEventsFilter, getUsers, getEventsUser } = useEvents()
const { cities, getCities } = useSites()

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
const thumbnail = ref();

onMounted(async () => {

    document.title = 'ConnectU - Home';
    const favicon = document.createElement('link');
    favicon.rel = 'icon';
    favicon.href = '/images/favicon-32x32.png';
    document.head.appendChild(favicon);

    const store = useStore();
    const user = computed(() => store.state.auth.user);

    await getCities()
    await getCategories()
    await getUsers()
    await getEvents()
    await getEventsUser(user.value.id)

    axios.get('/api/getThumbnail')
        .then(response => {
            thumbnail.value = response.data;
            console.log('Profile image URL:', thumbnail.value);
        })
        .catch(error => {
            console.error('Error al obtener la URL de la imagen de perfil:', error);
        });

    watch([search_global, search_category, search_id, search_name, search_description, search_location, search_start_date, search_end_date, search_user_id, orderColumn, orderDirection], () => {
        isLoadingEvents.value = true;
        filterEvents()
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

function getEventThumbnail(event) {
    return event && event.media && event.media.length > 0 ? event.media[0].original_url : '/images/default_thumbnail.png';
}


function getMediaEvent(event) {
    getUrlBannerEvent(event.id);
}


const showEvents = ref(false);
const showFilters = ref(false);
const screenWidth = ref(window.innerWidth);

const updateScreenWidth = () => {
    screenWidth.value = window.innerWidth;
};

window.addEventListener("resize", updateScreenWidth);

</script>