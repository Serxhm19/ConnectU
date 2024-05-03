<template>
    <div class="layout-wrapper" :class="containerClass">

        <Navbar />


        <div class="layout-main-container">

            <div class="layout-main">
                <Suspense>
                    <router-view></router-view>
                </Suspense>
            </div>
            <!--
            <div class="layout-sidebar">
                    
                <div class="card">
                    <app-sidebar></app-sidebar>
                </div>
                <Breadcrumb :home="home" :model="crumbs">
                    <template #item="{ item, props }">
                        <router-link v-if="item.route" v-slot="{ href, navigate }" :to="item.route" custom>
                            <a :href="href" v-bind="props.action" class="btn btn-link"   @click="navigate">
                                <span :class="[item.icon, 'text-color']" />
                                <span class="text-primary font-semibold">{{ item.label }}</span>
                            </a>
                        </router-link>
                        <a v-else :href="item.url" :target="item.target" v-bind="props.action">
                            <span class="text-color">{{ item.label }}</span>
                        </a>
                    </template>
</Breadcrumb>
</div>
-->
            <app-footer></app-footer>
        </div>

        <!--app-config></app-config-->
        <div class="layout-mask"></div>
    </div>
</template>
<script setup>
import Navbar from './Nav2.vue';
import AppFooter from './AppFooter.vue';
</script>

<style lang="scss" scoped>
.layout-main-container {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
    justify-content: space-between;
    padding: 1rem 1rem 1rem 1rem;
    transition: margin-left 0.2s;
    margin: 0;
}

.p-breadcrumb {
    padding: 10px 0 30px 10px;
    width: 30%;
    height: 92px;
    display: flex;
    align-items: center;
    margin-bottom: 28px;
}

.p-breadcrumb .p-breadcrumb-list {
    margin: 0 !important;
    padding: 0;
    list-style-type: none;
    display: flex;
    align-items: center;
    flex-wrap: nowrap;
}

ol {
    margin: 0 !important;
    padding: 0;
    list-style-type: none;
    display: flex;
    align-items: center;
    flex-wrap: nowrap;
}
</style>
