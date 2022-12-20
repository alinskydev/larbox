<script>
export default {
    inheritAttrs: false,
    props: {
        item: {
            type: Object,
            required: true,
        },
    },
    mounted() {
        $('#' + this.item.id).bootstrapSwitch('state', $('#' + this.item.id).prop('checked'));
    },
};
</script>

<template>
    <div class="mt-1">
        <input type="hidden" :name="item.name" value="0" />
        <input
            type="checkbox"
            v-bind="$attrs"
            value="1"
            :checked="item.value == 1"
            data-bootstrap-switch
            data-on-text="<i class='fas fa-check'></i>"
            data-off-text="<i class='fas fa-times'></i>"
            data-on-color="success"
            data-off-color="danger"
        />
    </div>
</template>
