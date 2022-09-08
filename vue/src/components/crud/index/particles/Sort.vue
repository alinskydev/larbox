<script setup>
import * as Enums from '@/core/base/enums';

import Input from '@/components/Input.vue';
</script>

<script>
export default {
    props: {
        fields: {
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
        let items = {};

        for (let key in this.fields) {
            let field = this.fields[key];

            items[field] = this.__('fields->' + field) + ' ↑';
            items['-' + field] = this.__('fields->' + field) + ' ↓';
        }

        this.item = {
            label: this.__('Сортировка'),
            name: 'sort',
            value: this.$route.query.sort,
            type: Enums.inputTypes.select,
            options: {
                select: {
                    items: items,
                    hasPrompt: true,
                },
            },
            size: Enums.inputSizes.sm,
        };
    },
};
</script>

<template>
    <Input :item="item" />
</template>
