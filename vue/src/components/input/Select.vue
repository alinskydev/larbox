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
            value: this.item.value,
            options: this.item.options,
            inputOptions: this.item.options.select ?? {},
            items: {},
        };
    },
    created() {
        this.value = this.inputOptions.isBoolean ? (this.value ? 1 : 0) : this.value;
        this.items = typeof this.inputOptions.items === 'function' ? this.inputOptions.items(this) : this.inputOptions.items;
    },
};
</script>

<template>
    <select v-bind="$attrs" :value="value">
        <option v-if="inputOptions.hasPrompt"></option>
        <option v-for="(selectItem, key) in items" :value="key">
            {{ selectItem }}
        </option>
    </select>
</template>
