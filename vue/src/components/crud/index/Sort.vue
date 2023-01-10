<script setup>
import * as Enums from '@/core/enums';

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
        let sortings = {};

        for (let key in this.fields) {
            let field = this.fields[key];

            sortings[field] = this.__('fields->' + field) + ' ↑';
            sortings['-' + field] = this.__('fields->' + field) + ' ↓';
        }

        this.item = {
            label: this.__('Сортировка'),
            name: 'sort',
            value: this.$route.query.sort,
            type: Enums.inputTypes.select,
            options: {
                select: {
                    items: sortings,
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
