<script setup>
import NavBar from './sideBar/NavBar.vue';
import RouterLink from "@/app/components/vue/RouterLink.vue";
</script>

<script>
export default {};
</script>

<template>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <RouterLink to="" class="brand-link">
            <img :src="booted.settings.logo"
                 class="brand-image img-circle elevation-3"
                 style="opacity: 0.8" />

            <span class="brand-text font-weight-light">
                {{ booted.settings.project_name }}
            </span>
        </RouterLink>

        <div class="sidebar">
            <NavBar />
        </div>
    </aside>
</template>