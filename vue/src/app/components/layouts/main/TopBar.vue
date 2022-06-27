<script setup>
import Breadcrumbs from './topBar/Breadcrumbs.vue';
import Languages from './topBar/Languages.vue';
import Profile from './topBar/Profile.vue';
</script>

<script>
export default {};
</script>

<template>
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <Breadcrumbs />

        <ul class="navbar-nav ml-auto">
            <Languages />
            <Profile />
        </ul>
    </nav>
</template>