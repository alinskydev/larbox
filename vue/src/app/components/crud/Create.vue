<script setup>
import * as crudEnums from '@/app/core/crud/enums';
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

        let fieldGroups = model.form,
            items = {};

        for (let fieldGroupKey in fieldGroups) {
            items[fieldGroupKey] = {};

            for (let fieldGroupKey in fieldGroups) {
                let fields = fieldGroups[fieldGroupKey];

                items[fieldGroupKey] = {};

                for (let fieldKey in fields) {
                    let field = fields[fieldKey],
                        name = fieldKey,
                        value = field.initValue;

                    if (name.includes('.')) {
                        name = name.split('.');
                        name = name.shift() + '[' + name.join('][') + ']';
                    }

                    if (typeof value === 'function') {
                        value = value(this);
                    }

                    items[fieldGroupKey][fieldKey] = {
                        label: this.__('fields->' + fieldKey),
                        name: name,
                        value: value,
                        type: field.type,
                        options: field.options ?? {},
                        size: field.size ?? crudEnums.inputSizes.lg,
                    };
                }
            }
        }

        this.items = items;
    },
};
</script>

<template>
    <FormAccordion :itemGroups="items" />
</template>