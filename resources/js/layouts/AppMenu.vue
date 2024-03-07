
<template>
    <ul class="layout-menu">
        <template v-if="userClass === 'User'">
            <template v-for="(item, i) in modelUser" :key="item">
                <app-menu-item v-if="!item.separator" :item="item" :index="i"></app-menu-item>
                <li v-if="item.separator" class="menu-separator"></li>
            </template>
        </template>
        <template v-else-if="userClass === 'Promoter'">
            <template v-for="(item, i) in modelPromoter" :key="item">
                <app-menu-item v-if="!item.separator" :item="item" :index="i"></app-menu-item>
                <li v-if="item.separator" class="menu-separator"></li>
            </template>
        </template>
    </ul>
</template>

<script setup>
import { ref } from 'vue';

const storageData = JSON.parse(localStorage.getItem('vuex'));

let userClass;
if (storageData.auth.user) {
    userClass = ref('User');
}else{
    userClass = ref('Promoter');
}

import AppMenuItem from './AppMenuItem.vue';
import { useAbility } from '@casl/vue';
const { can } = useAbility();

const vela = "pepe";
const modelPromoter = ref([
    {
        label: 'Usuario',
        items: [
            { label: 'Inicio', icon: 'pi pi-fw pi-home', to: '/admin/', permision: 'post-list' },
            { label: 'Mensajes', icon: 'pi pi-fw pi-comment', to: '/admin/chat', permision: 'post-list' },
            { label: 'Calendario', icon: 'pi pi-fw pi-calendar', to: '/admin/calendar', permision: 'post-list' },
            { label: 'Mi perfil', icon: 'pi pi-fw pi-user', to: '/admin/account', permision: 'post-list' },    
        ]
    },
    {
        label: 'Promotor',
        items: [
            { label: 'Crear evento', icon: 'pi pi-fw pi-plus', to: '/admin/events/create', permision: 'post-list' },
            { label: 'Mis eventos', icon: 'pi pi-fw pi-users', to: '/admin/events/my', permision: 'post-list' },
            { label: 'Chats de eventos', icon: 'pi pi-fw pi-comments', to: '/admin/posts', permision: 'post-list' },    
        ]
    }
]);

const modelUser = ref([
    {
        label: 'Usuario',
        items: [
            { label: 'Inicio', icon: 'pi pi-fw pi-home', to: '/admin/', permision: 'post-list' },
            { label: 'Mensajes', icon: 'pi pi-fw pi-comment', to: '/admin/chats', permision: 'post-list' },
            { label: 'Calendario', icon: 'pi pi-fw pi-calendar', to: '/admin/calendar', permision: 'post-list' },
            { label: 'Mi perfil', icon: 'pi pi-fw pi-user', to: '/admin/account', permision: 'post-list' },    
        ]
    }
]);
</script>

<style lang="scss" scoped></style>
