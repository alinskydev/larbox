<script>
export default {
    inheritAttrs: false,
    data() {
        return {
            currentValue: this.$attrs.options.isBoolean ? (this.$attrs.value ? 1 : 0) : this.$attrs.value,
            options: this.$attrs.options,
            modelId: this.$attrs.modelId,
            items: {},
        };
    },
    created() {
        if (typeof this.options.items === 'function') {
            this.items = this.options.items(this, this.currentValue);
        } else {
            this.items = this.options.items;
        }
    },
    methods: {
        send() {
            let value = this.$el.value,
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
                    this.$el.value = this.currentValue;
                }
            });
        },
    },
};
</script>

<template>
    <select @change="send" class="form-control" :value="currentValue">
        <option v-for="(item, key) in items" :value="key">
            {{ item }}
        </option>
    </select>
</template>