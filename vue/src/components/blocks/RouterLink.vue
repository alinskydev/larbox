<script setup>
import { RouterLink } from 'vue-router';
import App from '@/core/app';
</script>

<script>
export default {
    props: {
        to: {
            type: String,
            required: true,
        },
    },
    data() {
        return {
            isAllowed: App.helpers.user.checkRoute(this.to.split('?')[0]),
        };
    },
};
</script>

<template>
    <RouterLink v-if="isAllowed" :to="'/' + App.locale + '/' + to">
        <slot></slot>
    </RouterLink>
</template>
