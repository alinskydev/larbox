<script setup>
import Select from '@/app/components/inputs/Select.vue';
</script>

<script>
export default {
    inheritAttrs: false,
    props: {
        model: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            options: {
                items: {
                    '': this.__('Только действующие'),
                    'only-deleted': this.__('Только удалённые'),
                    'with-deleted': this.__('Все'),
                },
            },
            value: this.$route.query['show[deleted]'],
        };
    },
};
</script>

<template>
    <Select :name="$attrs.name"
            :value="value"
            :label="$attrs.label"
            :options="options"
            :wrapperSize="$attrs.wrapperSize" />
</template>