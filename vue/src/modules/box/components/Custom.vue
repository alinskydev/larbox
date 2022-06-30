<script>
export default {
    props: {
        text: {
            type: String,
            required: true,
        },
    },
};
</script>

<template>
    <h3 class="w-100 text-success">
        {{ text }}
    </h3>
</template>
