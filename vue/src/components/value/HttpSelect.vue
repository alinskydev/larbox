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
            currentValue: this.item.options.isBoolean ? (this.item.value ? 1 : 0) : this.item.value,
            items: {},
        };
    },
    created() {
        if (typeof this.item.options.items === 'function') {
            this.items = this.item.options.items(this, this.currentValue);
        } else {
            this.items = this.item.options.items;
        }
    },
    methods: {
        send() {
            let value = $('#' + this.item.id).val(),
                path = this.item.options.path.replace(':id', this.id).replace(':value', value);

            this.booted.helpers.http
                .send(this, {
                    method: 'PATCH',
                    path: path,
                })
                .then((response) => {
                    if (response.statusType === 'success') {
                        this.currentValue = value;

                        if (this.item.options.onSuccess) {
                            this.item.options.onSuccess(this, this.currentValue);
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
