<script setup>
import Wrapper from './_Wrapper.vue';
</script>

<script>
export default {
    data() {
        return {
            id: 'input-' + this.booted.helpers.string.uniqueId(),
        };
    },
    mounted() {
        $('#' + this.id).daterangepicker({
            autoUpdateInput: false,
            singleDatePicker: true,
            showDropdowns: true,
            autoApply: true,
            minYear: 1901,
            maxYear: parseInt(moment().format('YYYY')) + 10,
            timePicker: true,
            timePicker24Hour: true,
            locale: {
                format: 'DD.MM.YYYY HH:mm',
                firstDay: 1,
            },
        }).on('apply.daterangepicker', function (ev, picker) {
            let value = picker.startDate.format(picker.locale.format);
            $(this).val(value);
        });
    },
};
</script>

<template>
    <Wrapper :id="id" v-slot="main">
        <input type="text" v-bind="main.inputAttrs">
    </Wrapper>
</template>