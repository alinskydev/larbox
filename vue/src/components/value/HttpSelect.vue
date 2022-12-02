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
            valueOptions: this.item.options.httpSelect ?? {},
            currentValue: this.item.options.httpSelect?.isBoolean ? (this.item.value ? 1 : 0) : this.item.value,
            items: {},
        };
    },
    created() {
        if (typeof this.valueOptions.items === 'function') {
            this.items = this.valueOptions.items(this);
        } else {
            this.items = this.valueOptions.items;
        }
    },
    methods: {
        send() {
            let value = $('#' + this.item.id).val(),
                path = this.valueOptions.path.replace(':id', this.id).replace(':value', value);

            this.booted.helpers.http
                .send(this, {
                    method: 'PATCH',
                    path: path,
                })
                .then((response) => {
                    if (response.statusType === 'success') {
                        this.currentValue = value;

                        if (this.valueOptions.onSuccess) {
                            this.valueOptions.onSuccess(this, this.currentValue);
                        } else {
                            toastr.success(this.__('Успешно изменено'));
                        }
                    } else {
                        $('#' + this.item.id).val(this.currentValue);
                    }
                });
        },
    },
};
</script>

<template>
    <select @change="send" class="form-control" :id="item.id" :value="currentValue" v-bind="item.attributes">
        <option v-for="(selectItem, key) in items" :value="key">
            {{ selectItem }}
        </option>
    </select>
</template>
