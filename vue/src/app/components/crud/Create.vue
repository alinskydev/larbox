<script setup>
import FormAccordion from '@/app/components/crud/form/Accordion.vue';
</script>

<script>
export default {
    data() {
        return {
            model: this.booted.components.current.config.model,
            items: {},
        };
    },
    created() {
        // Page init

        this.booted.components.current.page.init();

        // Collecting items

        for (let key in this.model.form) {
            this.items[key] = this.model.prepareInputs(this, this.model.form[key]);
        }
    },
};
</script>

<template>
    <FormAccordion :itemGroups="items" />
</template>