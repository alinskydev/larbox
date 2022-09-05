<script setup>
import { RouterLink } from 'vue-router';
</script>

<script>
export default {
    props: {
        to: {
            type: String,
            required: true,
        },
    },
};
</script>

<template>
    <RouterLink :to="'/' + booted.locale + '/' + to">
        <slot></slot>
    </RouterLink>
</template>
