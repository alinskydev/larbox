<script setup>
import Accordion from '@/components/crud/form/Accordion.vue';
</script>

<script>
export default {
    data() {
        return {
            page: this.booted.components.current.page,
            config: this.booted.components.current.config,
            model: null,
        };
    },
    created() {
        this.page.init();
        this.model = Object.assign({}, this.config.model.fillData(this));
    },
};
</script>

<template>
    <Accordion v-if="model" :model="model" />
</template>
