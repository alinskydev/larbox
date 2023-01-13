<script>
export default {
    props: {
        item: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {};
    },
};
</script>

<template>
    <input type="hidden" :name="item.name" :value="item.value" />
</template>
