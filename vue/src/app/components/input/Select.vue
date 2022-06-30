<script>
export default {
    inheritAttrs: false,
    props: {
        item: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            value: this.item.options.isBoolean ? (this.item.value ? 1 : 0) : this.item.value,
            options: this.item.options,
            items: {},
        };
    },
    created() {
        this.items = typeof this.options.items === 'function' ? this.options.items(this) : this.options.items;
    },
};
</script>

<template>
    <select v-bind="$attrs" :value="value">
        <option v-if="options.withPrompt"></option>
        <option v-for="(selectItem, key) in items" :value="key">
            {{ selectItem }}
        </option>
    </select>
</template>