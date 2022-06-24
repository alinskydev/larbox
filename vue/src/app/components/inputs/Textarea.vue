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
        <textarea rows="5" v-bind="main.inputAttrs"></textarea>
    </Wrapper>
</template>