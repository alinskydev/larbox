<script>
export default {
    inheritAttrs: false,
    props: {
        item: {
            type: Object,
            required: true,
        },
        id: {
            type: Number,
            required: true,
        },
    },
    data() {
        return {
            valueOptions: this.item.options.httpSwitcher ?? {},
            currentValue: this.item.value ? 1 : 0,
        };
    },
    mounted() {
        $('#' + this.item.id).bootstrapSwitch('state', $('#' + this.item.id).prop('checked'));

        $('#' + this.item.id).on('switchChange.bootstrapSwitch', (event, state) => {
            let path = this.valueOptions.path.replace(':id', this.id).replace(':value', Number(state));

            this.booted.helpers.http
                .send(this, {
                    method: 'PATCH',
                    path: path,
                })
                .then((response) => {
                    if (response.statusType === 'success') {
                        this.currentValue = state;

                        if (this.valueOptions.onSuccess) {
                            this.valueOptions.onSuccess(this, this.currentValue);
                        } else {
                            toastr.success(this.__('Успешно изменено'));
                        }
                    } else {
                        $('#' + this.item.id).bootstrapSwitch('state', this.currentValue, true);
                    }
                });
        });
    },
};
</script>

<template>
    <input
        type="checkbox"
        v-bind="item.attributes"
        :id="item.id"
        :checked="currentValue"
        data-bootstrap-switch
        data-on-text="<i class='fas fa-check'></i>"
        data-off-text="<i class='fas fa-times'></i>"
        data-on-color="success"
        data-off-color="danger"
    />
</template>
