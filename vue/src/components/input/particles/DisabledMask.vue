<script>
export default {
    props: {
        attributes: {
            type: Object,
            default: {},
        },
    },
    data() {
        return {};
    },
};
</script>

<template>
    <div v-if="attributes.disabled || attributes.readonly" class="input-disabled-mask"></div>
</template>
