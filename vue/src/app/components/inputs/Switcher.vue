<script setup>
import Wrapper from './_Wrapper.vue';
</script>

<script>
export default {
    inheritAttrs: false,
    data() {
        return {
            id: 'input-' + this.booted.helpers.string.uniqueId(),
            isChecked: this.$attrs.value == 1 ? true : false,
        };
    },
    mounted() {
        $('#' + this.id).bootstrapSwitch('state', $('#' + this.id).prop('checked'));
    },
};
</script>

<template>
    <Wrapper :id="id" v-slot="main" v-bind="$attrs" :value="1">
        <div class="mt-1">
            <input type="hidden" :name="main.inputAttrs.name" value="0">
            <input type="checkbox"
                   v-bind="main.inputAttrs"
                   :checked="isChecked"
                   data-bootstrap-switch
                   data-on-color="success"
                   data-off-color="danger">
        </div>
    </Wrapper>
</template>