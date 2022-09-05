<script setup>
import Nav from './sideBar/Nav.vue';
import RouterLink from '@/app/components/blocks/RouterLink.vue';
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
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <RouterLink to="" class="brand-link">
            <img :src="booted.settings.logo" class="brand-image elevation-3" style="opacity: 0.8" />

            <span class="brand-text font-weight-light">
                {{ booted.settings.project_name }}
            </span>
        </RouterLink>

        <div class="sidebar">
            <Nav :key="templateKey" />
        </div>
    </aside>
</template>
