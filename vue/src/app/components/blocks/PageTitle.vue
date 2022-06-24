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
    <div class="content-header d-flex align-items-center justify-content-between mb-3">
        <h1>
            {{ text }}
        </h1>

        <div class="btn-group">
            <slot></slot>
        </div>
    </div>
</template>