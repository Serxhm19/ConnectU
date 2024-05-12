<template>
    <div class="container-fluid login-view">
        <div class="row">
            <!-- Columna para el logo -->
            <div class="col-md-4 col-sm-12">
                <div class="logo-central">
                    <svg width="400" height="400" viewBox="0 0 45 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_38_40)">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M16.6127 30.1064L22.6412 30.0683V45.9791C22.6412 45.9791 18.6036 45.9336 15.2293 44.4442C11.8549 42.9549 11.1068 42.4076 10.2632 41.8608C9.41962 41.3135 6.9637 39.5772 5.68912 37.8555C4.41453 36.1335 3.47121 35.4404 2.06256 32.2397C0.653879 29.0398 0.896767 29.6657 0.168144 25.3524C-0.560478 21.0387 1.18822 15.0091 3.27692 11.3449C5.36558 7.68077 12.1931 0.608568 22.6412 0C22.6386 7.56747 22.6412 15.7513 22.6412 15.7513H16.6127V7.19845C16.6127 7.19845 5.95114 11.73 6.26202 22.7676C6.5729 33.8052 12.7921 36.3428 16.6127 38.6236"
                                fill="black" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M26.4639 0.000152588C26.4639 0.000152588 29.7781 0.0630044 32.403 1.1863C32.4003 3.75304 32.403 38.5312 32.403 38.5312C32.403 38.5312 36.0774 37.0992 39.1527 33.4401C39.1527 28.5602 39.1527 4.63674 39.1527 4.63674C39.1527 4.63674 42.0256 6.34644 44.9629 10.4067C44.9637 15.5259 44.9629 35.6953 44.9629 35.6953C44.9629 35.6953 38.7649 45.3106 26.4639 45.9795C26.4635 40.2021 26.4639 0.000152588 26.4639 0.000152588Z"
                                fill="#01AFEE" />
                        </g>
                        <defs>
                            <clipPath id="clip0_38_40">
                                <rect width="45" height="46" fill="white" />
                            </clipPath>
                        </defs>
                    </svg>
                </div>
            </div>
            <!-- Columna para el formulario de inicio de sesión -->
            <div class="col-md-8 col-sm-12">
                <div class="login-container text-center animated flipInX">
                    <div class="card card-login">
                        <div class="logo">
                            <svg width="100" height="100" viewBox="0 0 45 46" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_38_40)">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M16.6127 30.1064L22.6412 30.0683V45.9791C22.6412 45.9791 18.6036 45.9336 15.2293 44.4442C11.8549 42.9549 11.1068 42.4076 10.2632 41.8608C9.41962 41.3135 6.9637 39.5772 5.68912 37.8555C4.41453 36.1335 3.47121 35.4404 2.06256 32.2397C0.653879 29.0398 0.896767 29.6657 0.168144 25.3524C-0.560478 21.0387 1.18822 15.0091 3.27692 11.3449C5.36558 7.68077 12.1931 0.608568 22.6412 0C22.6386 7.56747 22.6412 15.7513 22.6412 15.7513H16.6127V7.19845C16.6127 7.19845 5.95114 11.73 6.26202 22.7676C6.5729 33.8052 12.7921 36.3428 16.6127 38.6236"
                                        fill="black" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M26.4639 0.000152588C26.4639 0.000152588 29.7781 0.0630044 32.403 1.1863C32.4003 3.75304 32.403 38.5312 32.403 38.5312C32.403 38.5312 36.0774 37.0992 39.1527 33.4401C39.1527 28.5602 39.1527 4.63674 39.1527 4.63674C39.1527 4.63674 42.0256 6.34644 44.9629 10.4067C44.9637 15.5259 44.9629 35.6953 44.9629 35.6953C44.9629 35.6953 38.7649 45.3106 26.4639 45.9795C26.4635 40.2021 26.4639 0.000152588 26.4639 0.000152588Z"
                                        fill="#01AFEE" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_38_40">
                                        <rect width="45" height="46" fill="white" />
                                    </clipPath>
                                </defs>
                            </svg>
                        </div>
                        <div class="container-content">
                            <form @submit.prevent="submitLogin">
                                <!-- Tipo de usuario -->
                                <div class="">
                                    <!-- Email -->
                                    <div class="mb-3">
                                        <input v-model="loginForm.email" id="emailLogin" type="email"
                                            class="form-control" required autofocus autocomplete="email"
                                            placeholder="Email">
                                        <!-- Validation Errors -->
                                        <div class="text-danger mt-1">
                                            <div v-for="message in validationErrors?.email">
                                                {{ message }}
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Password -->
                                    <div class="mb-4">
                                        <input v-model="loginForm.password" id="passwordLogin" type="password"
                                            class="form-control" required autocomplete="current-password"
                                            placeholder="Password">
                                        <!-- Validation Errors -->
                                        <div class="text-danger-600 mt-1">
                                            <div v-for="message in validationErrors?.password">
                                                {{ message }}
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Remember me -->
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember"
                                            v-model="loginForm.remember" id="flexCheckIndeterminate">
                                        <label class="form-check-label" for="flexCheckIndeterminate">
                                            {{ $t('remember_me') }}
                                        </label>
                                    </div>

                                    <!-- Buttons -->
                                    <div class="flex items-center justify-end mt-4">
                                        <button class="btn btn-primary Login" :class="{ 'opacity-25': processing }"
                                            :disabled="processing">
                                            {{ $t('login') }}
                                        </button>
                                    </div>
                                </div>
                                <div class="forgot">
                                    <router-link :to="{ name: 'auth.forgot-password' }">{{
                                $t('forgot_password') }}</router-link>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-12 card-register">
                        <div class="card Register ">
                            <h2 class="RegisterText">Don't have an account?</h2> <router-link
                                :to="{ name: 'auth.register' }" class="btn btn-link btn-sm float-end">
                                Register
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</template>
<style scoped lang="scss">
@import "../../../sass/login";



</style>

<script setup>

import useAuth from '@/composables/auth'
import axios from "axios";
import { onMounted, ref } from "vue";
const { registerForm, validationErrors, processing, submitRegister, loginForm, submitLogin, registerFormPromoter, submitRegisterPromoter } = useAuth();


// Declaración de la referencia para almacenar la categoría seleccionada
const selectedCategory = ref(null);

const selectCategory = (categoryItem) => {
    registerFormPromoter.category_id = categoryItem.id;
    selectedCategory = categoryItem;
}

onMounted(async () => {

    document.title = 'ConnectU - LogIn';
    const favicon = document.createElement('link');
    favicon.rel = 'icon';
    favicon.href = '/images/favicon-32x32.png';
    document.head.appendChild(favicon);
});

// Carga inicial de las categorías
const category = ref([]);

axios.get("/api/category")
    .then(response => {
        category.value = response.data;
    })
    .catch(error => { console.log(error.message) });
</script>