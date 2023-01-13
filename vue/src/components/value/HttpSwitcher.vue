<script setup>
import App from '@/core/app';
</script>

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
        return {
            valueOptions: this.item.options.httpSwitcher ?? {},
            currentValue: this.item.value ? 1 : 0,
        };
    },
    mounted() {
        $('#' + this.item.elementId)
            .bootstrapSwitch('state', $('#' + this.item.elementId).prop('checked'))
            .on('switchChange.bootstrapSwitch', (event, state) => {
                let path = this.valueOptions.path.replace(':pk', this.item.pk).replace(':value', Number(state));

                App.helpers.http
                    .send({
                        method: 'PATCH',
                        path: path,
                    })
                    .then((response) => {
                        if (response.statusType === 'success') {
                            this.currentValue = state;

                            if (this.valueOptions.onSuccess) {
                                this.valueOptions.onSuccess(this.currentValue);
                            } else {
                                toastr.success(App.t('Успешно изменено'));
                            }
                        } else {
                            $('#' + this.item.elementId).bootstrapSwitch('state', this.currentValue, true);
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
        :id="item.elementId"
        :checked="currentValue"
        data-bootstrap-switch
        data-on-text="<i class='fas fa-check'></i>"
        data-off-text="<i class='fas fa-times'></i>"
        data-on-color="success"
        data-off-color="danger"
    />
</template>
