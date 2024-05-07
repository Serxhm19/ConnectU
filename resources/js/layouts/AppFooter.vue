<script setup>
import { useLayout } from '../composables/layout';
import { computed } from 'vue';

const { layoutConfig } = useLayout();

const logoUrl = computed(() => {
    return `layout/images/${layoutConfig.darkTheme.value? 'logo-white' : 'logo-dark'}.svg`;
});
</script>

<template>
    <div class="layout-footer">
        <div>
            <h2 class="Connect">Connect with us</h2>
            <ul class="social-links">
                <li>
                    <a href="https://www.facebook.com/" target="_blank">
                        <span class="pi pi-facebook social-icon"></span>
                    </a>
                </li>
                <li>
                    <a href="https://twitter.com/" target="_blank">
                        <span class="pi pi-twitter social-icon"></span>
                    </a>
                </li>
                <li>
                    <a href="https://www.instagram.com/" target="_blank">
                        <span class="pi pi-instagram social-icon"></span>
                    </a>
                </li>
                <li>
                    <a href="https://www.linkedin.com/company/" target="_blank">
                        <span class="pi pi-linkedin social-icon"></span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</template>

<style scoped>
.layout-footer {
    transition: margin-left 0.2s;
    display: flex;
    align-items: center;
    justify-content: center;
    padding-top: 1rem;
    border: none;
    /* border-top: 1px solid var(--surface-border); */
}

.social-links {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
}

.social-links li {
    margin: 0 10px;
}

.social-icon {
    font-size: 1.5em;
    border-radius: 50%;
    padding: 0.5em;
    color: #01afee;
    transition: background-color 0.2s;
}

.social-icon:hover {
    background-color: transparent;
    color: #0070bb;
}

.Connect {
    font-size: 22px;
    font-family: Gotham;
    color: #01afee;
    display: flex;
    align-content: center;
    justify-content: center;
}
</style>