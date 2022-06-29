<script setup>
import FormAccordion from '@/app/components/crud/form/Accordion.vue';
</script>

<script>
export default {
    data() {
        return {
            page: this.booted.components.page,
            items: {},
        };
    },
    created() {
        let model = this.page.model;

        // Page init

        this.page.$data.init();

        // Collecting items

        for (let key in model.form) {
            this.items[key] = model.prepareInputs(this, model.form[key]);
        }
    },
};
</script>

<template>
    <FormAccordion :itemGroups="items" />
</template>