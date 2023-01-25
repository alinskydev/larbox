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
        $('#' + this.item.elementId).on('change', (event) => {
            let value = event.target.checked,
                path = this.valueOptions.path.replace(':pk', this.item.pk).replace(':value', Number(value));

            App.helpers.http
                .send({
                    method: 'PATCH',
                    path: path,
                })
                .then((response) => {
                    if (response.statusType === 'success') {
                        this.currentValue = value;

                        if (this.valueOptions.onSuccess) {
                            this.valueOptions.onSuccess(this.currentValue);
                        } else {
                            toastr.success(App.t('Успешно изменено'));
                        }
                    } else {
                        event.target.checked = this.currentValue;
                    }
                });
        });
    },
};
</script>

<template>
    <span>
        <input type="checkbox" v-bind="item.attributes" :id="item.elementId" switch="none" :checked="currentValue" />
        <label :for="item.elementId" data-on-label="On" data-off-label="Off"></label>
    </span>
</template>
