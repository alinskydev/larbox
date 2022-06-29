<script setup>
import * as crudEnums from '@/app/core/crud/enums';

import Input from '@/app/components/Input.vue';
</script>

<script>
export default {
    props: {
        sortings: {
            type: Array,
            required: true,
        },
    },
    data() {
        return {
            item: {},
        };
    },
    created() {
        let options = {
            items: {},
            withPrompt: true,
        };

        for (let key in this.sortings) {
            let field = this.sortings[key];

            options.items[field] = this.__('fields->' + field) + ' ↑';
            options.items['-' + field] = this.__('fields->' + field) + ' ↓';
        }

        this.item = {
            label: this.__('Сортировка'),
            name: 'sort',
            value: this.$route.query.sort,
            type: crudEnums.inputTypes.select,
            options: options,
            size: crudEnums.inputSizes.sm,
        };
    },
};
</script>

<template>
    <Input :item="item" />
</template>