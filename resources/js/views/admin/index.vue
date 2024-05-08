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
                            <div v-for="event in events" :key="event.id">
                                <div class="d-flex justify-content-between mb-1">
                                    <div style="display: flex;">
                                        <img src="\images\eventoPrueba.webp" alt="" style="height: 30px; width: 30px; border-radius: 30px;">
                                        <h6 class="ml-3 mb-1 mt-1 text-left">{{ sliceData(event.name) }}</h6>
                                    </div>
                                </div>
                                <div class="d-flex w-100 justify-content-center">
                                    <p class="mb-1 mt-1 text-center" style="color: #6A6A6A; font-size: 13px;">{{ formatDate(event.start_date) }} - {{ formatDate(event.end_date) }}</p>
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
        {{ events.value }}
            <div style="border-radius: 40px;">
                <div v-for="event in events" :key="event.id" class="card event-home" style="border-radius: 20px;"> 
                    <div class="card-body" style="padding: 8px 14px;">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">{{ event.name }}</h5>
                            <p class="mb-1">{{ getName(cities, event.location) }}</p>
                        </div>
                    </div>
                    <img class="card-img-top" src="\images\eventoPrueba.webp" alt="Card image cap" style="height: 350px; border-radius: 0;">
                    <div class="card-body">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">{{ getUserName(event.user_id) }}</h5>
                            <p class="mb-1" style="color: grey">{{ formatDate(event.start_date) }} - {{ formatDate(event.end_date) }}</p>
                        </div>
                        <div class="d-flex justify-content-center" style="margin: 20px 30px;">
                            <p style="text-align: justify;">
                                {{  sliceDataDescription(event.description) }}
                            </p>
                        </div>
                        <div class="d-flex justify-content-between" style="margin: 20px 30px;">
                            <span style="color: #00AAC4">
                                #{{ getCategoryName(event.category_id) }}
                            </span>
                            <router-link :to="{ name: 'publi-event.event', params: { id: event.id } }" class="btn btn-link mr-3">Ver más...</router-link>
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
                        <InputText  placeholder="Search" />
                    </IconField>
                </div>
                <div class="card filter-location">
                    <div class="title-filter">
                        <h5>Ubicación del evento</h5>
                    </div>

                    <select class="select-ubi" id="province-selector">
                        <option value="" selected>Provincia</option>
                        <option v-for="province in provinces" :value="province.id">{{ province.name }}</option>
                    </select>

                    <select class="select-ubi" id="city-selector">
                        <option value="" selected>Ciudad</option>
                        <option v-for="city in cities" :value="city.id">{{ city.name }}</option>
                    </select>
                </div>
                <div class="card filter-location">
                    <div class="title-filter">
                        <h5>Fecha del evento</h5>
                    </div>
                    <div class="filter-date">
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
                            <div v-for="(category, index) in categories.slice(5, 10)" :key="index" >
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
    .content-events{
        margin-top: 0rem;
    }
    .gotham{
        font-family: Gotham;
    }
    .list-group-chat{
        border: 0;
    }

    .content-chats-view {
        position: fixed;
        top: 9rem;
        left: 20px;
        z-index: 997;
        width: 23%;
    }


    .chats hr{
        border: 1px solid black;
    }

    .event-home{
        padding: 0;
    }
    .event-home img{
        width: 100%;
        height: 200px;
        
    }




    /* FILTER CSS */
    .filters{
        width: 24%;
        max-height: 708px;
        overflow: auto;
    }
    .title-filter{
        font-size: 20px;
        text-align: center;
    }

    /*SEARCH LABEL CSS */
    .searchLabel{
        background-color: white;
        border-radius: 20px;
        margin-bottom: 20px;
        border: 1px solid black;
    }
    .searchLabel span{
        padding: 0 15px;
        border-right: 1px solid black;
    }
    input.p-inputtext{
        width: 87%;
        border-radius:  0 20px 20px 0;
        border: 0;
    }
    input.p-inputtext:focus{
        border: 0;
    }


    /*FILTER LOCATION CSS */
    .filter-location{
        padding: 15px;
        display: flex;
        flex-direction: column;
        justify-content: space-around;
        align-items: center;
        height: 150px;
        margin-bottom: 1rem;
    }
    .p-tree-wrapper ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
    }

    .select-ubi{
        border-radius: 20px;
        text-align: center;
        border: 1px solid black;
        width: 220px;
    }

    /* FILTER DATE CSS */
    .filter-date{
        display:flex;
        justify-content: center;
        width: 100%;
    }

    /* FILTER CATEGORIES CSS */
    .buttons-categories div{
        padding: 0;
    }
    .buttons-categories div p{
        color: #5D9EFF;
        width: auto;
        text-align: center;
        cursor: pointer;
    }
    .category-p{
        margin: 5px;
        transition: 0.5s;
    }
    .category-p:hover{
        color:#003262;
    }
    .category-p.selected{
        background-color: #0070BB;
        color: #fff;
        border-radius: 20px;
        padding: 0 1.5px;
    }
</style>
<script setup>
    import {useAbility} from '@casl/vue';
    import {ref, onMounted, watch} from "vue";

    import useCategories from "../../composables/categories_event";
    import useEvents from "../../composables/events";
    import useSites from "../../composables/sites";
    
    import IconField  from "primevue/iconField";
    import InputIcon  from "primevue/inputIcon";
    import InputText  from "primevue/inputText";
    
    const {categories, getCategories, deleteCategory} = useCategories()
    const {events, users,  getEvents, getEventsFilter, getUsers, deleteEvent} = useEvents()
    const {cities, provinces, getCities, getProvinces, getCitiesByProvince} = useSites()

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
        await getCategories()
        await getCities()
        await getProvinces()
        await getUsers()
        await getEvents()
        changeNameLocationEvent()
        
        const selectProvince = document.getElementById('province-selector');
        selectProvince.addEventListener('change', async function() {
            const selectedProvince = selectProvince.value;
            
            await getCitiesByProvince(selectedProvince);    
            console.log(cities.value)
        });

        const selectCity = document.getElementById('city-selector');
        selectCity.addEventListener('change', async function() {
            search_location.value = selectCity.value;
        });

        const categoryP = document.getElementsByClassName('category-p');
        const categoryArray = Array.from(categoryP);
        let eventsAux = events.value;
        categoryArray.forEach(categoryFilter => {
            categoryFilter.addEventListener('click', async () => {
                const categoryName = categoryFilter.innerHTML.substring(1);
                const categoryId = categories.value.find(category => category.name === categoryName)?.id;
                
                if (categoryFilter.classList.contains('selected')) {
                    categoryFilter.classList.remove('selected');

                    events.value = eventsAux;
                }else{
                    categoryArray.forEach(element => {
                        element.classList.remove('selected');
                    });

                    categoryFilter.classList.add('selected');
                    search_category.value = categories.value.find(cat => cat.name === categoryName).id
                }
            });
        });

        
    })

    watch([search_category, search_id, search_name, search_description, search_location, search_start_date, search_end_date, search_user_id, orderColumn, orderDirection], () => {
        getEventsFilter(1, search_category.value, search_id.value, search_name.value, search_description.value, search_location.value, search_start_date.value, search_end_date.value, search_user_id.value, orderColumn.value, orderDirection.value)
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

    function changeNameLocationEvent(){
        /*events.forEach(evento => {
            const city = cities.find(c => c.id === evento.location);
            if (city) {
                evento.location = city.name; // Añadir una nueva propiedad category_name al evento con el nombre de la categoría
            }
        });
        */
    }
    
</script>