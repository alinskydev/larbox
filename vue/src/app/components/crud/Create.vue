<script setup>
import Accordion from '@/app/components/crud/form/Accordion.vue';
</script>

<script>
export default {
    data() {
        return {
            model: this.booted.components.current.config.model,
            itemGroups: {},
        };
    },
    created() {

        // Page init

        this.booted.components.current.page.init();

        // Collecting item groups

        for (let key in this.model.form) {
            this.itemGroups[key] = this.model.prepareInputs(this, this.model.form[key]);
        }
    },
};
</script>

<template>
    <Accordion :itemGroups="itemGroups" />
</template>