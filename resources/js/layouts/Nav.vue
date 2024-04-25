<template>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav">
                        <li class="nav-item">
                            <router-link to="/" class="nav-link" aria-current="page">{{ $t('home') }}</router-link>
                        </li>
                        <!--
                        <li class="nav-item">
                            <router-link :to="{ name : 'public-posts.index'}" class="nav-link">Blog</router-link>
                        </li>
                        -->
                        <li class="nav-item">
                            <router-link to="/" class="layout-topbar-logo nav-link">
                                <img src="/images/connectu.svg" alt="logo" />
                                <span></span>
                            </router-link>
                        </li>
                    <template v-if="!user?.name">
                        <li class="nav-item">
                            <router-link class="nav-link" to="/login">
                                {{ $t('login') }}
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link class="nav-link" to="/register">
                                {{ $t('register') }}
                            </router-link>
                        </li>
                    </template>
                    <template v-if="user?.name">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="/images/connectu.svg" alt="" class="user-logo">{{ user.name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><router-link class="dropdown-item" to="/admin">Admin</router-link></li>
                                <li><router-link to="/admin/posts" class="dropdown-item">Post</router-link></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="javascript:void(0)" @click="logout">Logout</a></li>
                            </ul>
                        </li>
                    </template>
                </ul>
            </div>
        </div>
    </nav>
    <!--<p>nav.vue</p>-->
</template>

<script setup>
import { useStore} from "vuex";
import useAuth from "@/composables/auth";
import {computed} from "vue";
import LocaleSwitcher from "../components/LocaleSwitcher.vue";

    const store = useStore();
    const user = computed(() => store.getters["auth/user"])
    const { processing, logout } = useAuth();
</script>

<style>
    @media (min-width: 768px){
        .navbar-expand-md .navbar-collapse {
            display: flex !important;
            flex-basis: auto;
            align-items: center;
            justify-content: center;
        }
        .navbar-nav{
            display: flex;
            justify-content: center;
            width: 100%;    
        }

        .nav-item{
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .nav-item.dropdown{
            justify-self: end;
        }
        

        .nav-item a{
            font-family: Gotham;
        }

        .user-logo{
            width: 25px;
            height: 25px;
            margin-right: 10px;
        }
    }
</style>
