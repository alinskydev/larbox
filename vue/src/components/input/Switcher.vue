<script>
export default {
    inheritAttrs: false,
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
    <div class="mt-1">
        <input type="hidden" :name="item.name" value="0" />
        <input type="checkbox" v-bind="$attrs" value="1" :id="item.elementId" switch="none" :checked="item.value == 1" />
        <label :for="item.elementId" data-on-label="On" data-off-label="Off"></label>
    </div>
</template>
