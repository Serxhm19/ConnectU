
<style>
/* funcionamiento básico del sistema de pestañas */
.tab-content {
    display: none;
}

.tab:target .tab-content,
.tab:last-of-type .tab-content {
    display: block;
}

.tab:target~.tab:last-of-type .tab-content {
    display: none;
}

/* parámetros para configurar las pestañas */
:root {
    --tabs-border-color: #ABCDEF;
    --tabs-border-size: 3px;
    --tabs-text-color: white;
    --tabs-dark-color: #012345;
    --tabs-lite-color: #345678;
    --tabs-width: 120px;
    --tabs-height: 40px;
}

/* aspecto básico */
body {
    font-family: sans-serif;
    line-height: 1.2;
}

h2,
p {
    margin: 0;
}

a {
    color: inherit;
    text-decoration: none;
}

.tabs * {
    box-sizing: border-box;
}

/* esto es para posicionar las pestañas correctamente */
.tab-container {
    position: relative;
    padding-top: var(--tabs-height);
    /* en esta zona colocaremos las pestañas */
}

#tab1>a {
    --tabs-position: 0;
}

#tab2>a {
    --tabs-position: 1;
}

#tab3>a {
    --tabs-position: 2;
}

#tab4>a {
    --tabs-position: 3;
}

#tab5>a {
    --tabs-position: 4;
}

#tab6>a {
    --tabs-position: 5;
}

#tab7>a {
    --tabs-position: 6;
}

#tab8>a {
    --tabs-position: 7;
}

#tab9>a {
    --tabs-position: 8;
}

.tab>a {
    text-align: center;
    position: absolute;
    width: calc(var(--tabs-width));
    height: calc(var(--tabs-height) + var(--tabs-border-size));
    top: 0;
    left: calc(var(--tabs-width) * var(--tabs-position));
    /* posición de cada pestaña */
}

/* más aspecto */
.tabs {
    padding: 10px;
    color: var(--tabs-text-color);
}

.tab-content {
    background-color: var(--tabs-lite-color);
    padding: 20px;
    border: var(--tabs-border-size) solid var(--tabs-border-color);
    border-radius: 0 0 10px 10px;
    position: relative;
    z-index: 100;
    height: 600px;
}

.tab>a {
    background-color: var(--tabs-dark-color);
    padding: 10px;
    border: var(--tabs-border-size) solid var(--tabs-border-color);
    border-radius: 10px 10px 0 0;
    border-bottom: 0;
}

.tab:target>a,
.tab:last-of-type>a {
    background-color: var(--tabs-lite-color);
    z-index: 200;
}

.tab:target~.tab:last-of-type>a {
    background-color: var(--tabs-dark-color);
    z-index: 0;
}
</style>

<template>
    <section class="vh-100">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img src="images\LOGOPROV.svg" alt="Descripción de la imagen" style="height: 300px; width: 600px; " />
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <div class="tabs">
                        <div class="tab-container">
                            <div id="tab3" class="tab">
                                <a href="#tab3">{{ $t('register_as_promoter') }}</a>
                                <div class="tab-content">
                                    <h2>Register as promoter</h2>
                                    <p>Lorem ipsum ...</p>
                                </div>
                            </div>
                            <div id="tab2" class="tab">
                                <a href="#tab2">{{
                                    $t('register') }}</a>
                                <div class="tab-content">
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
                                            <input v-model="registerForm.email" id="emailRegister" type="email" class="form-control"
                                                required autofocus autocomplete="username" placeholder="Email">
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
                                            <input v-model="registerForm.password" id="passwordRegister" type="password"
                                                class="form-control" required autocomplete="current-password"
                                                placeholder="Password">
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
                                                <!-- Validation Errors -->
                                                <div class="text-danger-600 mt-1">
                                                    <div v-for="message in validationErrors?.genre">
                                                        {{ message }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex items-center justify-end mt-4">
                                            <button class="btn btn-primary" :class="{ 'opacity-25': processing }"
                                                :disabled="processing">
                                                {{ $t('register') }}
                                            </button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                            <div id="tab1" class="tab">
                                <a href="#tab1">{{
                                    $t('login') }}</a>
                                <div class="tab-content">
                                    <div class="container">
                                        <div class="row justify-content-center my-5">
                                            <form @submit.prevent="submitLogin">
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
                                                        <button class="btn btn-primary"
                                                            :class="{ 'opacity-25': processing }" :disabled="processing">
                                                            {{ $t('login') }}
                                                        </button>
                                                    </div>
                                                </div>
                                                <router-link :to="{ name: 'auth.forgot-password' }">{{
                                                    $t('forgot_password') }}</router-link>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>



    </section>
</template>

<script setup>

import useAuth from '@/composables/auth'

const { registerForm, validationErrors, processing, submitRegister, loginForm, submitLogin } = useAuth();

</script>