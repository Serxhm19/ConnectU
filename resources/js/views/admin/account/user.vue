<template>
    <div class="col-lg-12">
        <div class="card events">
            <div class="d-flex">
                <div class="d-flex mt-8">
                    <h4 class="title-other ml-0">Look your next events!</h4>
                    <div class="gradient-blue gradient-slader"></div>
                </div>
            </div>
            <div style="border-radius: 40px;">
                <div v-for="event in filteredEvents" :key="event.id" class="card event-home"
                    style="border-radius: 20px;">
                    <div class="card-body" style="padding: 8px 14px;">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">{{ event.name }}</h5>
                            <p class="mb-1">{{ event.location }}</p>
                        </div>
                    </div>
                    <img class="card-img-top" src="\images\logo.png" alt="Card image cap"
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
    </div>
</template>

<script setup>
import { useAbility } from '@casl/vue';
import { ref, onMounted, watch, computed } from "vue";
import useCategories from "../../../composables/categories_event";
import useEvents from "../../../composables/events";
import useSites from "../../../composables/sites";

const search_id = ref('');
const search_title = ref('');
const search_global = ref('');
const orderColumn = ref('created_at');
const orderDirection = ref('desc');
const { categories, getCategories, deleteCategory } = useCategories();
const { events, users, getEvents, getUsers } = useEvents();
const { can } = useAbility();
const { cities, getCities } = useSites()

onMounted(async () => {
    await getEvents();
    await getUsers();
    await getCities();
    fetchUserEvents();
    user.value = users.value.find(user => user.id === 1);


});

const user = ref(null);
const userEvents = ref([]);

const fetchUserEvents = () => {
    return new Promise((resolve, reject) => {
        axios.get(`/api/userEvent`)
            .then(response => {
                userEvents.value = response.data;
                console.log("1" + userEvents.value);
                resolve(); // Resuelve la promesa una vez que se hayan actualizado todas las ubicaciones
            })
            .catch(error => {
                console.error('Error fetching user events:', error);
                reject(error); // Rechaza la promesa en caso de error
            });
    });
};



const filteredEvents = computed(() => {
    const filtered = events.value.filter(event =>
        userEvents.value.some(userEvent => userEvent.event_id === event.id)
    )
    console.log("filtered" + events.value);

    filtered.forEach(async event => {
        const cityId = event.location;
        const cityName = await getName(cities.value, cityId);
        event.location = cityName;
        console.log(event.data);
    });

    // Devolver los eventos filtrados con las ubicaciones actualizadas
    return filtered;
});


watch([search_id, search_title, search_global], () => {
    getCategories(1, search_id.value, search_title.value, search_global.value);
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
</script>

<style scoped>
.gotham {
    font-family: Gotham;
}

.list-group-chat {
    border: 0;
}

.content-chats-view {
    position: fixed;
    top: 6rem;
    left: 20px;
    z-index: 997;
    width: 23%;
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

.events {
    height: 772px;
    overflow-y: auto;
    margin-left: -5px;
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

.gradient-blue.gradient-promoter-right {
    width: 20px;
    height: 100%;
    background: linear-gradient(to bottom right, transparent 49.5%, #0070BB 49.5%, #0070BB 30%);
}

.gradient-blue.gradient-promoter-left {
    width: 20px;
    height: 100%;
}
</style>
