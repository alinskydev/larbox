<script>
export default {
    inheritAttrs: false,
    data() {
        return {
            id: 'input-' + this.booted.helpers.string.uniqueId(),
            currentValue: this.$attrs.value ? true : false,
            options: this.$attrs.options,
            modelId: this.$attrs.modelId,
        };
    },
    mounted() {
        $('#' + this.id).bootstrapSwitch('state', $('#' + this.id).prop('checked'));

        $('#' + this.id).on('switchChange.bootstrapSwitch', (event, state) => {
            let $el = $(this.$el),
                value = $el.prop('checked') ? 1 : 0,
                path = this.options.path
                    .replace(':id', this.modelId)
                    .replace(':value', value);

            this.booted.helpers.http.send(this, {
                method: 'PATCH',
                path: path,
            }).then((response) => {
                if (response.statusType === 'success') {
                    this.currentValue = value;

                    if (this.options.onSuccess) {
                        this.options.onSuccess(this, this.currentValue);
                    } else {
                        toastr.success(this.__('Изменено'));
                    }
                } else {
                    $el.bootstrapSwitch('state', this.currentValue, true);
                }
            });
        });
    },
};
</script>

<template>
    <input type="checkbox"
           :id="id"
           :checked="currentValue"
           data-bootstrap-switch
           data-on-color="success"
           data-off-color="danger">
</template>