<template>
    <div class="container">
        <div class="row">
            <!-- Columna para el logo -->
            <div class="col-md-4">
                <img src="/images/logo.png" alt="Logo">
            </div>
            <!-- Columna para el formulario de inicio de sesión -->
            <div class="col-md-8">
                <div class="login-container text-center animated flipInX">
                    <div>
                    <h1 class="logo-badge"><span class="pi pi-fw pi-user"></span></h1>
                </div>
                <h3 class="text-whitesmoke">ConnectU</h3>
                <div class="card">
                    <p class="text-whitesmoke">Log In</p>
                    <div class="container-content">
                        <form @submit.prevent="submitLogin">
                            <!-- Tipo de usuario -->
                            <div class="">
                                <!-- Email -->
                                <div class="mb-3">
                                    <label for="email" class="form-label">{{ $t('email') }}</label>
                                    <input v-model="loginForm.email" id="emailLogin" type="email" class="form-control"
                                        required autofocus autocomplete="username">
                                    <!-- Validation Errors -->
                                    <div class="text-danger mt-1">
                                        <div v-for="message in validationErrors?.email">
                                            {{ message }}
                                        </div>
                                    </div>
                                </div>
                                <!-- Password -->
                                <div class="mb-4">
                                    <label for="password" class="form-label">
                                        {{ $t('password') }}
                                    </label>
                                    <input v-model="loginForm.password" id="passwordLogin" type="password"
                                        class="form-control" required autocomplete="current-password">
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
                                    <button class="btn btn-primary" :class="{ 'opacity-25': processing }"
                                        :disabled="processing">
                                        {{ $t('login') }}
                                    </button>
                                </div>
                            </div>
                            <router-link :to="{ name: 'auth.forgot-password' }">{{
                            $t('forgot_password') }}</router-link>
                        </form>
                        <p class="margin-t text-whitesmoke"><small> Your Name &copy; 2018</small> </p>
                    </div>
                </div>                </div>
            </div>
        </div>
    </div>

</template>
<style>
html {
    height: 100%;
}

body {
    height: 100%;
    margin: 0;
    background-repeat: no-repeat;
    background-attachment: fixed;
}

/* Text Align */
.text-c {
    text-align: center;
}

.text-l {
    text-align: left;
}

.text-r {
    text-align: right
}

.text-j {
    text-align: justify;
}

/* Text Color */
.text-whitesmoke {
    color: rgb(0, 0, 0);
    font-family: Arial, Helvetica, sans-serif;
    font-size: 22px;
}

.text-darkyellow {
    color: rgba(255, 235, 59, 0.432)
}

/* Lines */

.line-b {
    border-bottom: 1px solid #FFEB3B !important;
}

/* Buttons */
.button {
    border-radius: 3px;
}

.form-button {
    background-color: rgba(255, 235, 59, 0.24);
    border-color: rgba(255, 235, 59, 0.24);
    color: #e6e6e6;
}

.form-button:hover,
.form-button:focus,
.form-button:active,
.form-button.active,
.form-button:active:focus,
.form-button:active:hover,
.form-button.active:hover,
.form-button.active:focus {
    background-color: rgba(255, 235, 59, 0.473);
    border-color: rgba(255, 235, 59, 0.473);
    color: #e6e6e6;
}

.button-l {
    width: 100% !important;
}

/* Margins g(global) - l(left) - r(right) - t(top) - b(bottom) */

.margin-g {
    margin: 15px;
}

.margin-g-sm {
    margin: 10px;
}

.margin-g-md {
    margin: 20px;
}

.margin-g-lg {
    margin: 30px;
}

.margin-l {
    margin-left: 15px;
}

.margin-l-sm {
    margin-left: 10px;
}

.margin-l-md {
    margin-left: 20px;
}

.margin-l-lg {
    margin-left: 30px;
}

.margin-r {
    margin-right: 15px;
}

.margin-r-sm {
    margin-right: 10px;
}

.margin-r-md {
    margin-right: 20px;
}

.margin-r-lg {
    margin-right: 30px;
}

.margin-t {
    margin-top: 15px;
}

.margin-t-sm {
    margin-top: 10px;
}

.margin-t-md {
    margin-top: 20px;
}

.margin-t-lg {
    margin-top: 30px;
}

.margin-b {
    margin-bottom: 15px;
}

.margin-b-sm {
    margin-bottom: 10px;
}

.margin-b-md {
    margin-bottom: 20px;
}

.margin-b-lg {
    margin-bottom: 30px;
}

/* Bootstrap Form Control Extension */

.form-control,
.border-line {
    background-color: #5f5f5f;
    background-image: none;
    border: 1px solid #424242;
    border-radius: 1px;
    color: inherit;
    display: block;
    padding: 6px 12px;
    transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
    width: 100%;
}

.form-control:focus,
.border-line:focus {
    border-color: #FFEB3B;
    background-color: #616161;
    color: #e6e6e6;
}

.form-control,
.form-control:focus {
    box-shadow: none;
}

.form-control::-webkit-input-placeholder {
    color: #BDBDBD;
}

/* Container */

.container-content {
    background-color: #ffffffa2;
    color: inherit;
    padding: 15px 20px 20px 20px;
    border-color: #000000;
    border-image: none;
    border-style: solid solid none;
    border-width: 1px 0;
}

/* Backgrounds */

.main-bg {

    background: #424242;
    background: linear-gradient(#424242, #212121);
}

/* Login & Register Pages*/

.login-container {
    max-width: 500px;
    z-index: 100;
    margin: 0 auto;
    padding-top: 100px;
}

.login.login-container {
    width: 300px;
}

.wrapper.login-container {
    margin-top: 140px;
}

.logo-badge {
    color: #000000;
    font-weight: 800;
    letter-spacing: -10px;
    margin-bottom: 0;
}
</style>
<script setup>

import useAuth from '@/composables/auth'
import axios from "axios";
import { ref } from "vue";
const { registerForm, validationErrors, processing, submitRegister, loginForm, submitLogin, registerFormPromoter, submitRegisterPromoter } = useAuth();



// Declaración de la referencia para almacenar la categoría seleccionada
const selectedCategory = ref(null);

const selectCategory = (categoryItem) => {
    registerFormPromoter.category_id = categoryItem.id;
    selectedCategory = categoryItem;
}


// Carga inicial de las categorías
const category = ref([]);

axios.get("/api/category")
    .then(response => {
        category.value = response.data;
    })
    .catch(error => { console.log(error.message) });
</script>