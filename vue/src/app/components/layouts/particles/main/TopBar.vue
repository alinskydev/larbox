<script setup>
import Breadcrumbs from './topBar/Breadcrumbs.vue';
import Languages from './topBar/Languages.vue';
import Profile from './topBar/Profile.vue';
</script>

<script>
export default {
    props: {
        templateKey: {
            type: Number,
            required: true,
        },
    },
};
</script>

<template>
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <Breadcrumbs :key="templateKey" />

        <ul class="navbar-nav ml-auto">
            <Languages :key="templateKey" />
            <Profile />
        </ul>
    </nav>
</template>