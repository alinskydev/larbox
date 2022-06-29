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
    <input type="hidden" :name="item.name" :value="item.value">
</template>