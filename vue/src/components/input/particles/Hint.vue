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
    <div class="input-hint text-secondary mt-1">
        {{ text }}
    </div>
</template>
