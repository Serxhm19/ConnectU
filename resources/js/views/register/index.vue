<template>
    <div class="container-fluid h-custom">
        <div class="col-md-12 col-lg-6 col-xl-4 offset-xl-1">
            <div class=" card card-login">
                <div class="login-box">
                    <div class="login-snip">
                        <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1"
                            class="tab">Login</label>
                        <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Sign
                            Up</label>
                        <div class="login-space">
                            <div class="login">
                                <form @submit.prevent="submitLogin">
                                    <!-- Tipo de usuario -->
                                    <div class="">
                                        <!-- Email -->
                                        <div class="mb-3">
                                            <label for="email" class="form-label">{{ $t('email')
                                                }}</label>
                                            <input v-model="loginForm.email" id="emailLogin" type="email"
                                                class="form-control" required autofocus autocomplete="username">
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
                            </div>
                            <div class="sign-up-form">
                                <form @submit.prevent="submitRegister">
                                    <!-- Name -->
                                    <div class="mb-3">
                                        <label for="name" class="form-label">{{ $t('name') }}</label>
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
                                        <label for="surname" class="form-label">{{ $t('surname') }}</label>
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
                                        <label for="nickname" class="form-label">
                                            {{ $t('nickname') }}
                                        </label>
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
                                        <label for="email" class="form-label">{{ $t('email') }}</label>
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
                                        <label for="password" class="form-label">
                                            {{ $t('password') }}
                                        </label>
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
                                        <label for="password_confirmation" class="form-label">
                                            {{ $t('confirm_password') }}
                                        </label>
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
                                        <label class="form-label">{{ $t('genre') }}</label>
                                        <div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" id="genre-male"
                                                    value="male" v-model="registerForm.genre">
                                                <label class="form-check-label" for="genre-male">{{ $t('male')
                                                    }}</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" id="genre-female"
                                                    value="female" v-model="registerForm.genre">
                                                <label class="form-check-label" for="genre-female">{{ $t('female')
                                                    }}</label>
                                            </div>
                                            <!-- Checkbox para indicar si es promotor -->
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="is_Promoter"
                                                    v-model="registerForm.isPromoter" id="is_Promoter">
                                                <label class="form-check-label" for="is_Promoter">
                                                    {{ $t('is_Promoter') }}
                                                </label>
                                            </div>
                                            <!-- Campos adicionales para promotores -->
                                            <div v-if="registerForm.isPromoter">
                                                <!-- NIF -->
                                                <div class="mb-3">
                                                    <label for="nif" class="form-label">{{ $t('nif') }}</label>
                                                    <input v-model="registerForm.nif" id="nif" type="text"
                                                        class="form-control" placeholder="NIF">
                                                    <!-- Validation Errors -->
                                                    <div class="text-danger mt-1">
                                                        <div v-for="message in validationErrors?.nif">
                                                            {{ message }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Descripción -->
                                                <div class="mb-3">
                                                    <label for="description" class="form-label">{{ $t('description')
                                                        }}</label>
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
                                                    <label for="category_id" class="form-label">{{ $t('category')
                                                        }}</label>
                                                    <select v-model="registerForm.category_id" id="category_id"
                                                        class="form-control">
                                                        <option v-for="cat in category" :value="cat.id">{{ cat.name
                                                            }}</option>
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
                                                <button class="btn btn-primary" :class="{ 'opacity-25': processing }"
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
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>
<style>
.login-box {
    width: 100%;
    margin: auto;
    max-width: 525px;
    min-height: 670px;
    position: relative;
    box-shadow: 0 12px 15px 0 rgba(0, 0, 0, .24), 0 17px 50px 0 rgba(0, 0, 0, .19);
}

.login-snip {
    width: 100%;
    height: 100%;
    position: absolute;
    padding: 90px 70px 50px 70px;
    background: rgba(0, 77, 77, .9);
}

.login-snip .login,
.login-snip .sign-up-form {
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    position: absolute;
    transform: rotateY(180deg);
    backface-visibility: hidden;
    transition: all .4s linear;
}

.login-snip .sign-in,
.login-snip .sign-up,
.login-space .group .check {
    display: none;
}

.login-snip .tab,
.login-space .group .label,
.login-space .group .button {
    text-transform: uppercase;
}

.login-snip .tab {
    font-size: 22px;
    margin-right: 15px;
    padding-bottom: 5px;
    margin: 0 15px 10px 0;
    display: inline-block;
    border-bottom: 2px solid transparent;
}

.login-snip .sign-in:checked+.tab,
.login-snip .sign-up:checked+.tab {
    color: #fff;
    border-color: #1161ee;
}

.login-space {
    min-height: 345px;
    position: relative;
    perspective: 1000px;
    transform-style: preserve-3d;
}

.login-space .group {
    margin-bottom: 15px;
}

.login-space .group .label,
.login-space .group .input,
.login-space .group .button {
    width: 100%;
    color: #fff;
    display: block;
}

.login-space .group .input,
.login-space .group .button {
    border: none;
    padding: 15px 20px;
    border-radius: 25px;
    background: rgba(255, 255, 255, .1);
}

.login-space .group input[data-type="password"] {
    -webkit-text-security: circle;
}

.login-space .group .label {
    color: #aaa;
    font-size: 12px;
}

.login-space .group .button {
    background: #1161ee;
}

.login-space .group label .icon {
    width: 15px;
    height: 15px;
    border-radius: 2px;
    position: relative;
    display: inline-block;
    background: rgba(255, 255, 255, .1);
}

.login-space .group label .icon:before,
.login-space .group label .icon:after {
    content: '';
    width: 10px;
    height: 2px;
    background: #fff;
    position: absolute;
    transition: all .2s ease-in-out 0s;
}

.login-space .group label .icon:before {
    left: 3px;
    width: 5px;
    bottom: 6px;
    transform: scale(0) rotate(0);
}

.login-space .group label .icon:after {
    top: 6px;
    right: 0;
    transform: scale(0) rotate(0);
}

.login-space .group .check:checked+label {
    color: #fff;
}

.login-space .group .check:checked+label .icon {
    background: #1161ee;
}

.login-space .group .check:checked+label .icon:before {
    transform: scale(1) rotate(45deg);
}

.login-space .group .check:checked+label .icon:after {
    transform: scale(1) rotate(-45deg);
}

.login-snip .sign-in:checked+.tab+.sign-up+.tab+.login-space .login {
    transform: rotate(0);
}

.login-snip .sign-up:checked+.tab+.login-space .sign-up-form {
    transform: rotate(0);
}

*,
:after,
:before {
    box-sizing: border-box
}

.clearfix:after,
.clearfix:before {
    content: '';
    display: table
}

.clearfix:after {
    clear: both;
    display: block
}

a {
    color: inherit;
    text-decoration: none
}


.hr {
    height: 2px;
    margin: 60px 0 50px 0;
    background: rgba(255, 255, 255, .2);
}

.foot {
    text-align: center;
}

.card-login {
    width: 500px;
    left: 100px;
}

::placeholder {
    color: #b3b3b3;
}
</style>
<script setup>

import useAuth from '@/composables/auth'
import axios from "axios";
import { ref } from "vue";
const { registerForm, validationErrors, processing, submitRegister, loginForm, submitLogin, registerFormPromoter, submitRegisterPromoter } = useAuth();




// Carga inicial de las categorías
const category = ref([]);

axios.get("/api/category")
    .then(response => {
        category.value = response.data;
    })
    .catch(error => { console.log(error.message) });
</script>