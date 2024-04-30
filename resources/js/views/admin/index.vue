<template>   
<div class="grid">
    <div class="col-12 lg:col-3 xl:col-3">
        <div class="card-body content-chats-view">
            <div class="card mb-4">
                <div class="card-body chats">
                    <h3 class="mb-1 mt-1 text-center">My events</h3>
                    <hr>
                    <div class="list-group">
                        <div class="list-group-item list-group-chat">
                            <div v-for="event in events" :key="event.id">
                                <div class="d-flex justify-content-between mb-1">
                                    <div style="display: flex;">
                                        <img src="\images\logo.png" alt="" style="height: 30px; width: 30px; border-radius: 30px;">
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
    <div class="col-12 lg:col-6 xl:col-6">
            <div style="border-radius: 40px;">
                <div v-for="event in events" :key="event.id" class="card event-home" style="border-radius: 20px;"> 
                    <div class="card-body" style="padding: 8px 14px;">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">{{ event.name }}</h5>
                            <p class="mb-1">{{ event.location }}</p>
                        </div>
                    </div>
                    <img class="card-img-top" src="\images\logo.png" alt="Card image cap" style="height: 350px; border-radius: 0;">
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
        <div class="col-12 lg:col-3 xl:col-3">
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

                <TreeSelect class="no-list-style" v-model="selectedValue" :options="nodes" placeholder="Select Item" />


                
            </div>
                <div class="list-group">
                    <div v-for="category in categories" :key="category.id" class="list-group-item">
                        <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">{{ category.name }}</h5>
                                <p class="mb-1">{{ category.id }}</p>
                        </div>
                        <span>
                            {{ category.description }}
                        </span>
                    </div>
                </div>

        </div>
    </div>
<!--
                        <div class="card-body shadow-sm">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <input v-model="search_global" type="text" placeholder="Search..." class="form-control mb-4">
                                    <div class="list-group">

                                        <div v-for="category in categories" :key="category.id" class="list-group-item">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h5 class="mb-1">{{ category.name }}</h5>
                                                <p class="mb-1">{{ category.id }}</p>
                                            </div>
                                            <span>
                                                {{ category.description }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
-->
        <!--
        <div class="col-12 xl:col-6">
            <div class="card">
                <h5>Recent Sales</h5>
                <DataTable :value="products" :rows="5" :paginator="true" responsiveLayout="scroll">
                    <Column style="width: 15%">
                        <template #header> Image </template>
                        <template #body="slotProps">
                            <img :src="'demo/images/product/' + slotProps.data.image" :alt="slotProps.data.image" width="50" class="shadow-2" />
                        </template>
                    </Column>
                    <Column field="name" header="Name" :sortable="true" style="width: 35%"></Column>
                    <Column field="price" header="Price" :sortable="true" style="width: 35%">
                        <template #body="slotProps">
                            {{ formatCurrency(slotProps.data.price) }}
                        </template>
                    </Column>
                    <Column style="width: 15%">
                        <template #header> View </template>
                        <template #body>
                            <Button icon="pi pi-search" type="button" class="p-button-text"></Button>
                        </template>
                    </Column>
                </DataTable>
            </div>
            <div class="card">
                <div class="flex justify-content-between align-items-center mb-5">
                    <h5>Best Selling Products</h5>
                    <div>
                        <Button icon="pi pi-ellipsis-v" class="p-button-text p-button-plain p-button-rounded" @click="$refs.menu2.toggle($event)"></Button>
                        <Menu ref="menu2" :popup="true" :model="items"></Menu>
                    </div>
                </div>
                <ul class="list-none p-0 m-0">
                    <li class="flex flex-column md:flex-row md:align-items-center md:justify-content-between mb-4">
                        <div>
                            <span class="text-900 font-medium mr-2 mb-1 md:mb-0">Space T-Shirt</span>
                            <div class="mt-1 text-600">Clothing</div>
                        </div>
                        <div class="mt-2 md:mt-0 flex align-items-center">
                            <div class="surface-300 border-round overflow-hidden w-10rem lg:w-6rem" style="height: 8px">
                                <div class="bg-orange-500 h-full" style="width: 50%"></div>
                            </div>
                            
                            <span class="text-orange-500 ml-3 font-medium">%50</span>
                        </div>
                    </li>
                    <li class="flex flex-column md:flex-row md:align-items-center md:justify-content-between mb-4">
                        <div>
                            <span class="text-900 font-medium mr-2 mb-1 md:mb-0">Portal Sticker</span>
                            <div class="mt-1 text-600">Accessories</div>
                        </div>
                        <div class="mt-2 md:mt-0 ml-0 md:ml-8 flex align-items-center">
                            <div class="surface-300 border-round overflow-hidden w-10rem lg:w-6rem" style="height: 8px">
                                <div class="bg-cyan-500 h-full" style="width: 16%"></div>
                            </div>
                            <span class="text-cyan-500 ml-3 font-medium">%16</span>
                        </div>
                    </li>
                    <li class="flex flex-column md:flex-row md:align-items-center md:justify-content-between mb-4">
                        <div>
                            <span class="text-900 font-medium mr-2 mb-1 md:mb-0">Supernova Sticker</span>
                            <div class="mt-1 text-600">Accessories</div>
                        </div>
                        <div class="mt-2 md:mt-0 ml-0 md:ml-8 flex align-items-center">
                            <div class="surface-300 border-round overflow-hidden w-10rem lg:w-6rem" style="height: 8px">
                                <div class="bg-pink-500 h-full" style="width: 67%"></div>
                            </div>
                            <span class="text-pink-500 ml-3 font-medium">%67</span>
                        </div>
                    </li>
                    <li class="flex flex-column md:flex-row md:align-items-center md:justify-content-between mb-4">
                        <div>
                            <span class="text-900 font-medium mr-2 mb-1 md:mb-0">Wonders Notebook</span>
                            <div class="mt-1 text-600">Office</div>
                        </div>
                        <div class="mt-2 md:mt-0 ml-0 md:ml-8 flex align-items-center">
                            <div class="surface-300 border-round overflow-hidden w-10rem lg:w-6rem" style="height: 8px">
                                <div class="bg-green-500 h-full" style="width: 35%"></div>
                            </div>
                            <span class="text-green-500 ml-3 font-medium">%35</span>
                        </div>
                    </li>
                    <li class="flex flex-column md:flex-row md:align-items-center md:justify-content-between mb-4">
                        <div>
                            <span class="text-900 font-medium mr-2 mb-1 md:mb-0">Mat Black Case</span>
                            <div class="mt-1 text-600">Accessories</div>
                        </div>
                        <div class="mt-2 md:mt-0 ml-0 md:ml-8 flex align-items-center">
                            <div class="surface-300 border-round overflow-hidden w-10rem lg:w-6rem" style="height: 8px">
                                <div class="bg-purple-500 h-full" style="width: 75%"></div>
                            </div>
                            <span class="text-purple-500 ml-3 font-medium">%75</span>
                        </div>
                    </li>
                    <li class="flex flex-column md:flex-row md:align-items-center md:justify-content-between mb-4">
                        <div>
                            <span class="text-900 font-medium mr-2 mb-1 md:mb-0">Robots T-Shirt</span>
                            <div class="mt-1 text-600">Clothing</div>
                        </div>
                        <div class="mt-2 md:mt-0 ml-0 md:ml-8 flex align-items-center">
                            <div class="surface-300 border-round overflow-hidden w-10rem lg:w-6rem" style="height: 8px">
                                <div class="bg-teal-500 h-full" style="width: 40%"></div>
                            </div>
                            <span class="text-teal-500 ml-3 font-medium">%40</span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-12 xl:col-6">
            <div class="card">
                <h5>Sales Overview</h5>
            </div>
            <div class="card">
                <div class="flex align-items-center justify-content-between mb-4">
                    <h5>Notifications</h5>
                    <div>
                        <Button icon="pi pi-ellipsis-v" class="p-button-text p-button-plain p-button-rounded" @click="$refs.menu1.toggle($event)"></Button>
                        <Menu ref="menu1" :popup="true" :model="items"></Menu>
                    </div>
                </div>

                <span class="block text-600 font-medium mb-3">TODAY</span>
                <ul class="p-0 mx-0 mt-0 mb-4 list-none">
                    <li class="flex align-items-center py-2 border-bottom-1 surface-border">
                        <div class="w-3rem h-3rem flex align-items-center justify-content-center bg-blue-100 border-circle mr-3 flex-shrink-0">
                            <i class="pi pi-dollar text-xl text-blue-500"></i>
                        </div>
                        <span class="text-900 line-height-3"
                            >Richard Jones
                            <span class="text-700">has purchased a blue t-shirt for <span class="text-blue-500">79$</span></span>
                        </span>
                    </li>
                    <li class="flex align-items-center py-2">
                        <div class="w-3rem h-3rem flex align-items-center justify-content-center bg-orange-100 border-circle mr-3 flex-shrink-0">
                            <i class="pi pi-download text-xl text-orange-500"></i>
                        </div>
                        <span class="text-700 line-height-3">Your request for withdrawal of <span class="text-blue-500 font-medium">2500$</span> has been initiated.</span>
                    </li>
                </ul>

                <span class="block text-600 font-medium mb-3">YESTERDAY</span>
                <ul class="p-0 m-0 list-none">
                    <li class="flex align-items-center py-2 border-bottom-1 surface-border">
                        <div class="w-3rem h-3rem flex align-items-center justify-content-center bg-blue-100 border-circle mr-3 flex-shrink-0">
                            <i class="pi pi-dollar text-xl text-blue-500"></i>
                        </div>
                        <span class="text-900 line-height-3"
                            >Keyser Wick
                            <span class="text-700">has purchased a black jacket for <span class="text-blue-500">59$</span></span>
                        </span>
                    </li>
                    <li class="flex align-items-center py-2 border-bottom-1 surface-border">
                        <div class="w-3rem h-3rem flex align-items-center justify-content-center bg-pink-100 border-circle mr-3 flex-shrink-0">
                            <i class="pi pi-question text-xl text-pink-500"></i>
                        </div>
                        <span class="text-900 line-height-3"
                            >Jane Davis
                            <span class="text-700">has posted a new questions about your product.</span>
                        </span>
                    </li>
                </ul>
            </div>
            
        </div>
    </div>
    -->
</template>
<style>
    .list-group-chat{
        border: 0;
    }

    .content-chats-view {
        position: fixed; /* Para fijar el contenido en la ventana del navegador */
        top: 8rem; /* Opcional: Fijar el contenido a 20px desde la parte superior */
        left: 20px; /* Opcional: Fijar el contenido a 20px desde el lado izquierdo */
        /* También puedes usar bottom o right para fijar desde la parte inferior o derecha */
        z-index: 997; /* Opcional: Definir un índice z para controlar la superposición */
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
    .title-filter{
        font-size: 20px;
    }

    /*SEARCH LABEL CSS */
    .searchLabel{
        background-color: white;
        border-radius: 20px;
        margin-bottom: 20px;
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
    }
    
    .p-treeselect{
        display: flex;
        align-items: center;
        justify-content: center;
        width: 70%;
    }
</style>
<script setup>
    import { NodeService } from '../../composables/sites';
    
    import {ref, onMounted, watch} from "vue";
    import useCategories from "../../composables/categories_event";
    import useEvents from "../../composables/events";
    import {useAbility} from '@casl/vue'
    import IconField  from "primevue/iconField";
    import InputIcon  from "primevue/inputIcon";
    import InputText  from "primevue/inputText";
    import TreeSelect  from "primevue/treeselect";

    const nodes = ref(null);
    const selectedValue = ref(null);

    onMounted(() => {
        NodeService.getTreeNodes().then((data) => (nodes.value = data));
    });


    const search_id = ref('')
    const search_title = ref('')
    const search_global = ref('')
    const orderColumn = ref('created_at')
    const orderDirection = ref('desc')
    const {categories, getCategories, deleteCategory} = useCategories()
    const {events, users,  getEvents, getUsers, deleteEvent} = useEvents()
    const {can} = useAbility()

    onMounted(() => {
        getCategories()
        getEvents()
        getUsers()
        console.log(users)
    })

    const updateOrdering = (column) => {
        orderColumn.value = column;
        orderDirection.value = (orderDirection.value === 'asc') ? 'desc' : 'asc';
        getCategories(
            1,
            search_id.value,
            search_title.value,
            search_global.value,
            orderColumn.value,
            orderDirection.value
        );
    }
    watch(search_id, (current, previous) => {
        getCategories(
            1,
            current,
            search_title.value,
            search_global.value
        )
    })
    watch(search_title, (current, previous) => {
        getCategories(
            1,
            search_id.value,
            current,
            search_global.value
        )
    })
    watch(search_global, _.debounce((current, previous) => {
        getCategories(
            1,
            search_id.value,
            search_title.value,
            current
        )
    }, 200))


    function getCategoryName(categoryId) {
        const category = categories.value.find(cat => cat.id === categoryId);
        // Retornar el nombre de la categoría si se encuentra, de lo contrario, retorna un mensaje de error
        return category ? category.name : 'Uncategorized';
    }

    function getUserName(id) {
        const user = users.value.find(userValue => userValue.id === id);
        // Retornar el nombre de la categoría si se encuentra, de lo contrario, retorna un mensaje de error
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
</script>