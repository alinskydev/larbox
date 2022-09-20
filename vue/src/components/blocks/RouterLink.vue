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
    data() {
        return {
            isAllowed: this.booted.helpers.user.checkRoute(this, this.to.split('?')[0]),
        };
    },
};
</script>

<template>
    <RouterLink v-if="isAllowed" :to="'/' + booted.locale + '/' + to">
        <slot></slot>
    </RouterLink>
</template>
