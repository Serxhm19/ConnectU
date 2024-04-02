<template>
    <div class="container">
        <div class="row">
            <!-- Columna para el formulario de inicio de sesión -->
            <div class="col-md-12">
                <div class="login-container text-center animated flipInX">
                    <div class="card">
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
                        <div>
                            <p>Descubre eventos emocionantes. Regístrate para participar. ¡Únete a la diversión!</p>
                        </div>
                        <hr class="hr">
                        <div class="sign-up-form">
                            <form @submit.prevent="submitRegister">
                                <!-- Name -->
                                <div class="mb-3">
                                    <input v-model="registerForm.name" id="name" type="name" class="form-control"
                                        required autofocus autocomplete="name" placeholder="Name">
                                    <!-- Validation Errors -->
                                    <div class="text-danger mt-1">
                                        <div v-for="message in validationErrors?.name">
                                            {{ message }}
                                        </div>
                                    </div>
                                </div>
                                <!-- surname -->
                                <div class="mb-3">
                                    <input v-model="registerForm.surname" id="surname" type="surname"
                                        class="form-control" required autofocus placeholder="Surname">
                                    <!-- Validation Errors -->
                                    <div class="text-danger mt-1">
                                        <div v-for="message in validationErrors?.surname">
                                            {{ message }}
                                        </div>
                                    </div>
                                </div>
                                <!-- Nickname -->
                                <div class="mb-4">
                                    <input v-model="registerForm.nickname" id="nickname" type="nickname"
                                        class="form-control" required autocomplete="current-nickname"
                                        placeholder="Nickname">
                                    <!-- Validation Errors -->
                                    <div class="text-danger-600 mt-1">
                                        <div v-for="message in validationErrors?.nickname">
                                            {{ message }}
                                        </div>
                                    </div>
                                </div>
                                <!-- Email input -->
                                <div class="mb-3">
                                    <input v-model="registerForm.email" id="emailRegister" type="email"
                                        class="form-control" required autofocus autocomplete="username"
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
                                    <input v-model="registerForm.password" id="password" type="password"
                                        class="form-control" autocomplete="current-password" placeholder="Password">
                                    <!-- Validation Errors -->
                                    <div class="text-danger-600 mt-1">
                                        <div v-for="message in validationErrors?.password">
                                            {{ message }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <input v-model="registerForm.password_confirmation" id="password_confirmation"
                                        type="password" class="form-control" autocomplete="current-password"
                                        placeholder="Confirm Password">
                                    <!-- Validation Errors -->
                                    <div class="text-danger-600 mt-1">
                                        <div v-for="message in validationErrors?.password_confirmation">
                                            {{ message }}
                                        </div>
                                    </div>
                                </div>

                                <!-- Gender -->
                                <div class="mb-3">
                                    <div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="genre-male" value="male"
                                                v-model="registerForm.genre">
                                            <label class="form-check-label" for="genre-male">{{ $t('male')
                                                }}</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="genre-female"
                                                value="female" v-model="registerForm.genre">
                                            <label class="form-check-label" for="genre-female">{{ $t('female')
                                                }}</label>
                                        </div>
                                    </div>
                                    <hr class="hr">
                                    <div>
                                        <p>¿Eres un promotor de eventos? Por favor, marca esta casilla para completar
                                            el registro.</p>
                                    </div>
                                    <div class="mb-3">
                                        <!-- Checkbox para indicar si es promotor -->
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="is_Promoter"
                                                v-model="registerForm.isPromoter" id="is_Promoter">
                                            <label class="form-check-label" for="is_Promoter">
                                                {{ $t('is_Promoter') }}
                                            </label>
                                        </div>
                                    </div>
                                    <!-- Campos adicionales para promotores -->
                                    <div v-if="registerForm.isPromoter">
                                        <!-- NIF -->
                                        <div class="mb-3">
                                            <input v-model="registerForm.nif" id="nif" type="text" class="form-control"
                                                placeholder="NIF">
                                            <!-- Validation Errors -->
                                            <div class="text-danger mt-1">
                                                <div v-for="message in validationErrors?.nif">
                                                    {{ message }}
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Descripción -->
                                        <div class="mb-3">
                                            <textarea v-model="registerForm.description" id="description"
                                                class="form-control" placeholder="Description"></textarea>
                                            <!-- Validation Errors -->
                                            <div class="text-danger mt-1">
                                                <div v-for="message in validationErrors?.description">
                                                    {{ message }}
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Categoría -->
                                        <div class="mb-3">
                                            <select v-model="registerForm.category_id" id="category_id"
                                                class="form-control">
                                                <option value="" disabled selected>Select category</option>
                                                <option v-for="cat in category" :value="cat.id">{{ cat.name }}
                                                </option>
                                            </select>
                                            <!-- Validation Errors -->
                                            <div class="text-danger mt-1">
                                                <div v-for="message in validationErrors?.category_id">
                                                    {{ message }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Botón de registro -->
                                    <div class="flex items-center justify-end mt-4">
                                        <button class="btn btn-primary Login" :class="{ 'opacity-25': processing }"
                                            :disabled="processing">
                                            {{ $t('register') }}
                                        </button>
                                    </div>
                                    <!-- Validation Errors -->
                                    <div class="text-danger-600 mt-1">
                                        <div v-for="message in validationErrors?.genre">
                                            {{ message }}
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>
<style>
html {
    height: 100%;
    background-color: #002C6F;
}


h2 {
    font-family: Gotham;
    font-size: 16px;
}

.btn.btn-link.btn-sm.float-end {
    font-family: Gotham;
    font-size: 16px;
}

p {
    font-family: Gotham;
    font-size: 14px;

}

.hr {
    border: 1px solid #000;
    background-color: #000;
    color: #000;
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
    color: rgba(0, 0, 0, 0.432)
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
    background-color: #ffffff;
    background-image: none;
    border: 1px solid #000000;
    border-radius: 30px;
    color: inherit;
    display: block;
    padding: 6px 12px;
    transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
    width: 100%;
    margin-top: 10px;
    font-family: Gotham;
    font-size: 12px;

}

.form-control,
.form-control:focus {
    box-shadow: none;
}

.form-control::-webkit-input-placeholder {
    color: #8e8e8e;
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

.form-check-label {
    float: left;
    font-family: Gotham;
    font-size: 14px;
}

.logo {
    margin: 0 10px 20px 10px;
}

.logo-central {
    margin-top: 200px;
}

.btn.btn-primary.Login {
    font-family: Gotham;
    width: 100%;
    justify-content: center;
    background-color: #002C6F;
}

.btn.btn-primary.Login:hover {
    font-family: Gotham;
    width: 100%;
    justify-content: center;
    background-color: #01AFEE;
}

.card-register {
    width: 500px;
}

.forgot {
    margin-top: 20px;
    font-family: Gotham;
}

.form-check.form-check-inline {
    margin-left: auto;
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