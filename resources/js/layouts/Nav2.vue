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
                        <li>
                            <router-link to="/" class="nav-link menu-a" aria-current="page">
                                <a href="#0" class="link-wrapper">
                                    <span class="Text">{{ $t('home') }}</span>
                                    <span><i class="pi pi-home Icon" style="font-size: 22px;"></i></span>
                                </a>
                            </router-link>
                        </li>
                        <li>
                            <router-link to="/" class="layout-topbar-logo">
                                <img src="/images/connectu.svg" alt="logo" />
                                <span></span>
                            </router-link>
                        </li>
                        <li>
                            <router-link to="/" class="nav-link menu-a" aria-current="page">
                                <a href="#0" class="link-wrapper">
                                    <span class="Text">{{ $t('chats') }}</span>
                                    <span><i class="pi pi-comments Icon" style="font-size: 22px;"></i></span>
                                </a>
                            </router-link>
                        </li>
                    </ul>
                </div>
                <template v-if="user?.name">
                    <div class="Account">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <img src="/images/connectu.svg" alt="" class="user-logo">{{ user.name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><router-link class="dropdown-item" to="/admin">Admin</router-link></li>
                                <li><router-link to="/admin/posts" class="dropdown-item">Post</router-link></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="javascript:void(0)" @click="logout">Logout</a></li>
                            </ul>
                        </li>
                    </div>
                </template>
            </div>
        </nav>
        <!--<p>nav.vue</p>-->
    </nav>
</template>

<script setup>
import { useStore } from "vuex";
import useAuth from "@/composables/auth";
import { computed } from "vue";
import LocaleSwitcher from "../components/LocaleSwitcher.vue";

const store = useStore();
const user = computed(() => store.getters["auth/user"])
const { processing, logout } = useAuth();
</script>

<style scoped>
@media (min-width: 768px) {
    .navbar-expand-md .navbar-collapse {
        display: flex !important;
        flex-basis: auto;
        align-items: center;
        justify-content: center;
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
        margin-right: -145px;
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

    .Account {}

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
}
</style>
