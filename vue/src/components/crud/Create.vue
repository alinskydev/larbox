<script setup>
import { CreateConfig } from '@/core/crud/configs';
import Accordion from '@/components/crud/form/Accordion.vue';
</script>

<script>
export default {
    props: {
        config: {
            type: CreateConfig,
            required: true,
        },
    },
    data() {
        return {
            model: Object.assign({}, this.config.model.fillData(this)),
        };
    },
};
</script>

<template>
    <Accordion v-if="model" :config="config" :model="model" />
</template>
