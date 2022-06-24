<script setup>
import Wrapper from './_Wrapper.vue';
</script>

<script>
export default {
    inheritAttrs: false,
    data() {
        return {
            id: 'input-' + this.booted.helpers.string.uniqueId(),
            value: this.$attrs.options.isBoolean ? (this.$attrs.value ? 1 : 0) : this.$attrs.value,
            options: this.$attrs.options,
            items: {},
        };
    },
    created() {
        this.items = typeof this.options.items === 'function' ? this.options.items(this) : this.options.items;
    },
};
</script>

<template>
    <Wrapper :id="id" v-slot="main" v-bind="$attrs" :value="value">
        <select v-bind="main.inputAttrs">
            <option v-if="options.withPrompt"></option>
            <option v-for="(item, key) in items" :value="key">
                {{ item }}
            </option>
        </select>
    </Wrapper>
</template>