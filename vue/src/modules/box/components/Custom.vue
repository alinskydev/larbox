<script setup>
import App from '@/core/app';
</script>

<script>
export default {
    props: {
        text: {
            type: String,
            required: true,
        },
    },
    data() {
        return {};
    },
};
</script>

<template>
    <h3 class="w-100 text-success m-0">
        {{ text }}
    </h3>
</template>
