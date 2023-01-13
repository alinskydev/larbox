<script>
export default {
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
    <div class="input-hint text-secondary mt-1">
        {{ text }}
    </div>
</template>
