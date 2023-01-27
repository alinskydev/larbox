<script>
export default {
    props: {
        errorKey: {
            type: String,
            required: true,
        },
    },
};
</script>

<template>
    <div :data-error-key="errorKey" class="input-error alert alert-danger p-2 mt-1 d-none"></div>
</template>
