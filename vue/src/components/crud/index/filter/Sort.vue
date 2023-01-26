<script setup>
import App from '@/core/app';
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

            sortings[field] = App.t('fields->' + field) + ' ↑';
            sortings['-' + field] = App.t('fields->' + field) + ' ↓';
        }

        this.item = {
            label: App.t('Сортировка'),
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
