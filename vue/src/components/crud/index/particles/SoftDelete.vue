<script setup>
import * as Enums from '@/core/enums';

import Input from '@/components/Input.vue';
</script>

<script>
export default {
    data() {
        return {
            item: {
                label: this.__('Отображать'),
                name: 'show[deleted]',
                value: this.$route.query['show[deleted]'],
                type: Enums.inputTypes.select,
                options: {
                    select: {
                        items: {
                            '': this.__('Только действующие'),
                            'only-deleted': this.__('Только удалённые'),
                            'with-deleted': this.__('Все'),
                        },
                    },
                },
                size: Enums.inputSizes.sm,
            },
        };
    },
};
</script>

<template>
    <Input :item="item" />
</template>
