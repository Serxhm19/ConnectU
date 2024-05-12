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