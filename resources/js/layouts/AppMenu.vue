
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
import AppMenuItem from './AppMenuItem.vue';
import { useAbility } from '@casl/vue';

const storageData = JSON.parse(localStorage.getItem('vuex'));

let userClass;
if (storageData.auth.user) {
    userClass = ref('Promoter');
}else{
    userClass = ref('Promoter');
}


const { can } = useAbility();

const vela = "pepe";
const modelPromoter = ref([
    {
        label: 'Usuario',
        items: [
            { label: '', icon: 'pi pi-fw pi-home', to: '/admin/', permision: 'post-list' },
            { label: '', icon: 'pi pi-fw pi-comment', to: '/admin/chat', permision: 'post-list' },
            { label: '', icon: 'pi pi-fw pi-calendar', to: '/admin/calendar', permision: 'post-list' },
            { label: '', icon: 'pi pi-fw pi-user', to: '/admin/account', permision: 'post-list' },    
            { label: '', icon: 'pi pi-fw pi-users', to: '/admin/events/', permision: 'post-list' },
            { label: '', icon: 'pi pi-fw pi-plus', to: '/admin/events/create', permision: 'post-list' },
            { label: '', icon: 'pi pi-fw pi-comments', to: '/admin/events/edit', permision: 'post-list' },    
        ]
    }
]);

const modelUser = ref([
    {
        label: 'Usuario',
        items: [
            { label: '', icon: 'pi pi-fw pi-home', to: '/admin/', permision: 'post-list' },
            { label: '', icon: 'pi pi-fw pi-comment', to: '/admin/chats', permision: 'post-list' },
            { label: '', icon: 'pi pi-fw pi-calendar', to: '/admin/calendar', permision: 'post-list' },
            { label: '', icon: 'pi pi-fw pi-user', to: '/admin/account', permision: 'post-list' },    
        ]
    }
]);
</script>

<style lang="scss" scoped></style>