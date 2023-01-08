<script>
export default {
    props: {
        item: {
            type: Object,
            required: true,
        },
    },
};
</script>

<template>
    <span v-if="Object.keys(item.attributes).length > 0" v-bind="item.attributes">
        <slot />
    </span>

    <slot v-else />
</template>
