<script>
export default {
    inheritAttrs: false,
    props: {
        text: {
            type: String,
            required: true,
        },
    },
    data() {
        return {};
    },
};
</script>

<template>
    <h1 class="float-start m-0" v-bind="$attrs">
        {{ text }}
    </h1>
</template>
