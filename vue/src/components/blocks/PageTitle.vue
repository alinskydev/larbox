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
    <div class="content-header d-flex align-items-center justify-content-between mb-4">
        <h1 v-bind="$attrs">
            {{ text }}
        </h1>

        <div class="btn-group">
            <slot></slot>
        </div>
    </div>
</template>
