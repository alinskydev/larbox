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
                    format: 'HH:mm',
                },
            })
            .on('show.daterangepicker', function (event, picker) {
                picker.container.find('.calendar-table').hide();
            })
            .on('apply.daterangepicker', function (event, picker) {
                let value = picker.startDate.format(picker.locale.format);
                $(this).val(value);
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
    <input type="text" />
</template>
