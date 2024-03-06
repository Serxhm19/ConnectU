<template>
    <section class="vh-100">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img src="images/logo.svg" alt="Descripción de la imagen" />
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <div>
                        <h1>ConnectU</h1>
                    </div>
                    <div class="divider d-flex align-items-center my-4">
                        <button type="button" class="btn btn-light"><router-link class="nav-link" to="/">{{
                            $t('login') }}</router-link></button>
                        <button type="button" class="btn btn-light"> <router-link class="nav-link" to="/register">{{
                            $t('register') }}</router-link>
                        </button>
                        <button type="button" class="btn btn-light"> <router-link class="nav-link" to="/registerPromoter">{{
                            $t('register as promoter') }}</router-link>
                        </button>
                    </div>

                    <form @submit.prevent="submitLogin">
                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label">{{ $t('name') }}</label>
                            <input v-model="loginForm.name" id="name" type="name" class="form-control" required autofocus
                                autocomplete="name" placeholder="Name">
                            <!-- Validation Errors -->
                            <div class="text-danger mt-1">
                                <div v-for="message in validationErrors?.email">
                                    {{ message }}
                                </div>
                            </div>
                        </div>
                        <!-- Surname -->
                        <div class="mb-3">
                            <label for="surname" class="form-label">{{ $t('surname') }}</label>
                            <input v-model="loginForm.surname" id="Surname" type="Surname" class="form-control" required
                                autofocus placeholder="Surname">
                            <!-- Validation Errors -->
                            <div class="text-danger mt-1">
                                <div v-for="message in validationErrors?.email">
                                    {{ message }}
                                </div>
                            </div>
                        </div>
                        <!-- Nickname -->
                        <div class="mb-4">
                            <label for="nickname" class="form-label">
                                {{ $t('nickname') }}
                            </label>
                            <input v-model="loginForm.nickname" id="nickname" type="nickname" class="form-control" required
                                autocomplete="current-nickname" placeholder="Nickname">
                            <!-- Validation Errors -->
                            <div class="text-danger-600 mt-1">
                                <div v-for="message in validationErrors?.password">
                                    {{ message }}
                                </div>
                            </div>
                        </div>
                        <!-- Email input -->
                        <div class="mb-3">
                            <label for="email" class="form-label">{{ $t('email') }}</label>
                            <input v-model="loginForm.email" id="email" type="email" class="form-control" required autofocus
                                autocomplete="username" placeholder="Email">
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
                            <input v-model="loginForm.password" id="password" type="password" class="form-control" required
                                autocomplete="current-password" placeholder="Contraseña">
                            <!-- Validation Errors -->
                            <div class="text-danger-600 mt-1">
                                <div v-for="message in validationErrors?.password">
                                    {{ message }}
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <!-- Remember me -->
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" v-model="loginForm.remember"
                                    id="flexCheckIndeterminate">
                                <label class="form-check-label" for="flexCheckIndeterminate">
                                    {{ $t('remember_me') }}
                                </label>
                            </div>
                            <a href="#!" class="text-body">Forgot password?</a>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button class="btn btn-primary" :class="{ 'opacity-25': processing }" :disabled="processing">
                                {{ $t('login') }}
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <div
            class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-primary">
            <!-- Copyright -->
            <div class="text-white mb-3 mb-md-0">
                Copyright © 2020. All rights reserved.
            </div>
            <!-- Copyright -->

            <!-- Right -->
            <div>
                <a href="#!" class="text-white me-4">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#!" class="text-white me-4">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="#!" class="text-white me-4">
                    <i class="fab fa-google"></i>
                </a>
                <a href="#!" class="text-white">
                    <i class="fab fa-linkedin-in"></i>
                </a>
            </div>
            <!-- Right -->
        </div>
    </section>
</template>

<script setup>

import useAuth from '@/composables/auth'

const { loginForm, validationErrors, processing, submitLogin } = useAuth();

</script>
