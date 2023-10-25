<script setup>
import App from '@/core/app';
</script>

<script>
export default {
    props: {
        item: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            moment: moment,
        };
    },
    mounted() {
        $('#' + this.item.elementId)
            .daterangepicker({
                autoUpdateInput: false,
                singleDatePicker: true,
                showDropdowns: true,
                autoApply: true,
                minYear: 1901,
                maxYear: parseInt(moment().format('YYYY')) + 10,
                locale: {
                    format: App.config.formats.date,
                    firstDay: 1,
                },
            })
            .on('apply.daterangepicker', function (event, picker) {
                let pickerValue = picker.startDate.format(picker.locale.format),
                    hiddenValue = picker.startDate.format('YYYY-MM-DD');

                $(this).val(pickerValue);
                $(this).next().val(hiddenValue);
            });

        $('#' + this.item.elementId).on('focusout', (event) => {
            let $el = $(event.currentTarget);
            if ($el.val() === '') $el.next().val('');
        });
    },
    beforeUnmount() {
        $('#' + this.item.elementId)
            .data('daterangepicker')
            .remove();
    },
};
</script>

<template>
    <input
        type="text"
        v-bind="$attrs"
        :name="null"
        :value="$attrs.value ? moment($attrs.value).format(App.config.formats.date) : null"
    />

    <input type="hidden" :name="$attrs.name" :value="$attrs.value" />
</template>
