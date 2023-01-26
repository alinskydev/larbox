<script setup>
import { CreateConfig } from '@/core/crud/configs';
import Data from '@/components/crud/form/Data.vue';
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
            model: Object.assign({}, this.config.model.fillData()),
        };
    },
};
</script>

<template>
    <Data v-if="model" :config="config" :model="model" />
</template>
