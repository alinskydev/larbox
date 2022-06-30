<script setup>
import * as crudEnums from '@/app/core/crud/enums';

import Input from '@/app/components/Input.vue';
</script>

<script>
export default {
    data() {
        return {
            item: {
                label: this.__('Отображать'),
                name: 'show[deleted]',
                value: this.$route.query['show[deleted]'],
                type: crudEnums.inputTypes.select,
                options: {
                    items: {
                        '': this.__('Только действующие'),
                        'only-deleted': this.__('Только удалённые'),
                        'with-deleted': this.__('Все'),
                    },
                },
                size: crudEnums.inputSizes.sm,
            },
        };
    },
};
</script>

<template>
    <Input :item="item" />
</template>