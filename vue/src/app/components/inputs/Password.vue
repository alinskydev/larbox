<script setup>
import Wrapper from './_Wrapper.vue';
</script>

<script>
export default {
    data() {
        return {
            id: 'input-' + this.booted.helpers.string.uniqueId(),
        };
    },
};
</script>

<template>
    <Wrapper :id="id" v-slot="main">
        <input type="password" v-bind="main.inputAttrs">
    </Wrapper>
</template>