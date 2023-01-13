<script setup>
import App from '@/core/app';
import * as Enums from '@/core/enums';

import Input from '@/components/Input.vue';
</script>

<script>
export default {
    data() {
        return {
            item: {
                label: App.t('Отображать'),
                name: 'show[deleted]',
                value: this.$route.query['show[deleted]'],
                type: Enums.inputTypes.select,
                options: {
                    select: {
                        items: {
                            '': App.t('Только действующие'),
                            'only-deleted': App.t('Только удалённые'),
                            'with-deleted': App.t('Все'),
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
