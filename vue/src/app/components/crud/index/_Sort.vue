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
                items: {},
                withPrompt: true,
            },
            value: this.$route.query.sort,
        };
    },
    created() {
        for (let key in this.model.sortings) {
            let field = this.model.sortings[key];

            this.options.items[field] = this.__('fields->' + field) + ' ↑';
            this.options.items['-' + field] = this.__('fields->' + field) + ' ↓';
        }
    },
};
</script>

<template>
    <Select :name="$attrs.name"
            :value="value"
            :label="$attrs.label"
            :options="options"
            :size="$attrs.size" />
</template>