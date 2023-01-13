<script>
export default {
    props: {
        item: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {};
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
                timePicker: true,
                timePicker24Hour: true,
                locale: {
                    format: 'DD.MM.YYYY HH:mm:ss',
                    firstDay: 1,
                },
            })
            .on('apply.daterangepicker', function (ev, picker) {
                let value = picker.startDate.format(picker.locale.format);
                $(this).val(value);
            });
    },
};
</script>

<template>
    <input type="text" />
</template>
