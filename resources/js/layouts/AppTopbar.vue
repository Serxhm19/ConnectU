<template>
    <nav v-if="!$route.meta.hideHeader">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="menu">
                        <li> <router-link to="/chats" class="nav-link menu-a" aria-current="page">
                                <a href="#0" class="link-wrapper">
                                    <span class="Text">{{ $t('chats') }}</span>
                                    <span><i class="pi pi-comments Icon" style="font-size: 22px;"></i></span>
                                </a>
                            </router-link>
                        </li>
                        <li class="logo-wrapper">
                            <router-link to="/admin" class="layout-topbar-logo">
                                <img src="/images/connectu.svg" alt="logo" />
                                <span></span>
                            </router-link>
                        </li>
                        <li>
                            <router-link to="/admin/account" class="nav-link menu-a" aria-current="page">
                                <a href="#0" class="link-wrapper">
                                    <span class="Text">{{ $t('account') }}</span>
                                    <span><i class="pi pi-user Icon" style="font-size: 22px;"></i></span>
                                </a>
                            </router-link>
                        </li>
                        <template v-if="user?.name">
                            <div class="Account">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <img v-if="user.profile_image_url" :src="user.profile_image_url"
                                            alt="Profile Picture" class="user-logo">
                                        <img v-else src="/images/default-profile-image.png"
                                            alt="Default Profile Picture" class="user-logo">
                                        {{ user.name }}
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><router-link class="dropdown-item" to="/admin/account">My
                                                Account</router-link></li>
                                        <li><router-link to="/chats" class="dropdown-item">Chats</router-link></li>
                                        <li><router-link to="/admin/events/create" class="dropdown-item">Create
                                                Event</router-link></li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item" href="javascript:void(0)"
                                                @click="logout">Logout</a>
                                        </li>
                                    </ul>
                                </li>
                            </div>
                        </template>
                    </ul>
                </div>

            </div>
        </nav>
        <!--<p>nav.vue</p>-->
    </nav>
</template>


<script setup>
import { useStore } from "vuex";
import useAuth from "@/composables/auth";
import { computed, onMounted } from "vue";
import LocaleSwitcher from "../components/LocaleSwitcher.vue";

const store = useStore();
const user = computed(() => store.getters["auth/user"])
const { processing, logout } = useAuth();

onMounted(async () => {

    console.log(promoter);
    document.title = 'ConnectU - Event';
    const favicon = document.createElement('link');
    favicon.rel = 'icon';
    favicon.href = '/images/favicon-32x32.png';
    document.head.appendChild(favicon);

    evento_id = route.params.id;

    await getCountParticipants(evento_id);
    await getUsers(event.value.user_id);
    await signedUpUser(user.id, evento_id);
    await getPromoterEvent;

    loading.value = false;

    const userId = promoter.id;
    console.log("Promter" + userId);

    axios.get(`/api/getProfileImageUrl`)
        .then(response => {
            profileImageUrl.value = response.data;
            console.log('URL de la imagen de perfil del usuario:', profileImageUrl.value);
        })
        .catch(error => {
            console.error('Error al obtener la URL de la imagen de perfil del usuario:', error);
        });


    axios.get('/api/getThumbnail')
        .then(response => {
            thumbnail.value = response.data;
            console.log('Profile image URL:', thumbnail.value);
        })
        .catch(error => {
            console.error('Error al obtener la URL de la imagen de perfil:', error);
        });

});

</script>
<style scoped>
nav.navbar.navbar-expand-md.navbar-light.bg-white.shadow-sm {
    position: fixed;
    top: 0;
    left: 50%;
    transform: translateX(-50%);
    z-index: 1000;
    width: 100%;
}

@media (min-width: 768px) {
    .navbar-expand-md .navbar-collapse {
        display: flex !important;
        flex-basis: auto;
        align-items: center;
        justify-content: center;
        margin-left: 150px;

    }

    .navbar-nav {
        display: flex;
        justify-content: center;
        width: 100%;
    }

    .nav-item {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .nav-item.dropdown {
        justify-self: end;
    }


    .nav-item a {
        font-family: Gotham;
    }

    .user-logo {
        width: 25px;
        height: 25px;
        margin-right: 10px;
    }

    ul {
        list-style: none;
    }

    a {
        color: inherit;
        text-decoration: none;
    }

    body {
        margin: 30px 0;
        font: 22px sans-serif;
        background: var(--body-bg-color);
        color: var(--text-color);
    }

    hr {
        border-color: var(--hr-color);
        margin: 20px 0;
    }

    .menu {
        display: flex;
        justify-content: center;
    }

    .menu li {
        margin-right: 70px;
    }

    .menu-a {
        position: relative;
        display: block;
        overflow: hidden;
    }

    .menu a span {
        transition: transform 0.2s ease-out;
    }

    .menu a span:first-child {
        display: inline-block;
        padding: 10px;
    }

    .menu a span:last-child {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        transform: translateY(-100%);
    }

    .menu i {
        font-size: 30px;
    }

    .menu a:hover span:first-child {
        transform: translateY(100%);
    }

    .menu a:hover span:last-child,
    .menu[data-animation] a:hover span:last-child {
        transform: none;
    }

    .Text {
        font-size: 16px;
        font-family: Gotham;
        color: #0070bb;
        margin-top: 15px;
        width: auto;
    }

    .Icon {
        color: #0070bb;
        margin-top: 10px;
    }

    .layout-topbar-logo {
        width: 30px;
        height: 30px;
    }

    .layout-topbar-logo img {
        height: 50px;
        margin-top: 40px;
    }

    .Account {
        margin-left: auto;
        /* Utiliza márgenes automáticos para desplazar a la derecha */
        margin-top: 25px;
        /* Mantén el margen superior según sea necesario */
    }



    /* ANIMATIONS
–––––––––––––––––––––––––––––––––––––––––––––––––– */
    .menu[data-animation="to-top"] a span:last-child {
        transform: translateY(100%);
    }

    .menu[data-animation="to-top"] a:hover span:first-child {
        transform: translateY(-100%);
    }

    .menu[data-animation="to-right"] a span:last-child {
        transform: translateX(-100%);
    }

    .menu[data-animation="to-right"] a:hover span:first-child {
        transform: translateX(100%);
    }

    .menu[data-animation="to-left"] a span:last-child {
        transform: translateX(100%);
    }

    .menu[data-animation="to-left"] a:hover span:first-child {
        transform: translateX(-100%);
    }

    .logo-wrapper {
        display: flex;
        justify-content: center;
        /* Centra el contenido horizontalmente */
        width: 100%;
        /* Ajusta el ancho según sea necesario */
    }

    .logo-wrapper .layout-topbar-logo {
        width: 30px;
        height: 30px;
    }

    .logo-wrapper .layout-topbar-logo img {
        height: 50px;
        margin-top: 40px;
    }



}

@media (max-width: 768px) {
    .navbar-collapse .navbar-expand-md {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .menu li {
        list-style: none;
        margin-right: 20px;
        text-decoration: none;
    }

    .layout-topbar-logo img {
        height: 2.5rem;
        margin: auto;
    }

    .menu a span.Text {
        display: none;
    }

    .menu a span.Icon {
        font-size: 24px;
    }

    .Account {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 10px;
    }

    ol,
    ul,
    dl {
        margin-top: 0;
        margin-bottom: 1rem;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .nav-link.menu-a span.Text {
        display: none;
    }

    .nav-link.menu-a span.Icon {
        font-size: 24px;
    }

    .logo-wrapper.layout-topbar-logo img {
        height: 30px;
    }

    .logo-wrapper {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .ml-auto {
        margin-left: auto;
        /* Estilo para alinear a la derecha */
    }


    .user-logo {
        display: none;
        /* Ocultar la imagen de perfil en dispositivos móviles */
    }
}
</style>
