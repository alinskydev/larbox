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
            valueOptions: this.item.options.httpSelect ?? {},
            currentValue: typeof this.item.value === 'boolean' ? (this.item.value ? 1 : 0) : this.item.value,
            items: {},
        };
    },
    created() {
        this.items = this.valueOptions.items ?? {};
    },
    methods: {
        send() {
            let value = $('#' + this.item.elementId).val(),
                path = this.valueOptions.path.replace(':pk', this.item.pk).replace(':value', value);

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
                        $('#' + this.item.elementId).val(this.currentValue);
                    }
                });
        },
    },
};
</script>

<template>
    <select @change="send" class="form-control" :id="item.elementId" :value="currentValue" v-bind="item.attributes">
        <option v-for="(selectItem, key) in items" :value="key">
            {{ selectItem }}
        </option>
    </select>
</template>
