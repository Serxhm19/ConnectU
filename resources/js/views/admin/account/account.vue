<template>
    <div class="grid">
        <div class="col-12">
            <div class="card"
                style="background-image: url('/images/logo.png'); background-size: cover; border: 2px solid white;">
                <div class="card-body">
                    <div class="d-flex justify-content-between pb-2 mb-4">
                    </div>
                </div>
                <div class="d-flex align-items-left">
                    <img src="\images\logo.png" class="profile-pic" alt="Profile Picture">
                </div>
            </div>
        </div>
    </div>

    <div class="grid">
        <div class="col-4">
            <div class="card">
                <div class="col-12">
                    <h3 class="nickname">
                        @{{ user.nickname }}
                    </h3>
                </div>
                <div>
                    <div class="col-4">
                        <h2 class="name">
                            {{ user.name }} {{ user.surname }}
                        </h2>
                    </div>
                </div>
                <div class="col-2">
                    <button type="button" class="btn btn-secondary button-edit pi pi-fw pi-user-edit"></button>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card">

            </div>
        </div>
    </div>
    <div class="grid">
        <div class="col-4">
            <div class="card">

            </div>
        </div>
    </div>
</template> 

<script setup>

import { useStore } from 'vuex';
import { ref, computed, onMounted, onBeforeUnmount } from 'vue';
const store = useStore();
const user = computed(() => store.state.auth.user)

</script>
<style scoped> .profile-pic {
     top: 9rem;
     left: 2.5rem;
     position: relative;
     z-index: 3;
     width: 200px;
     height: 200px;
     border-radius: 50%;
     object-fit: cover;
     border: 2px solid rgb(255, 255, 255);

 }

 .nickname {
     margin-top: 6rem;
     color: rgb(0, 0, 0);
     font-size: 28px;
     margin-left: 1rem;
 }

 .name {
     color: rgb(0, 0, 0);
     font-size: 20px;
     margin-top: -1rem;
     margin-left: 1rem;

 }

 .email {
     color: rgb(0, 0, 0);
     font-size: 20px;
     margin-top: 2px;
 }

 .button-edit {
     top: 1rem;
     left: 36.5rem;
     position: absolute;
     width: 40px;
     height: 40px;
     border-radius: 50%;
 }
</style>
