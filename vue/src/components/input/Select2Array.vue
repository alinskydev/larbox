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
            value: this.item.value ? Object.values(this.item.value) : [],
            inputOptions: this.item.options.select2Array ?? {},
            items: {},
        };
    },
    created() {
        if (this.inputOptions.items) {
            this.items = typeof this.inputOptions.items === 'function' ? this.inputOptions.items(this) : this.inputOptions.items;
        } else {
            this.items = this.value.reduce((obj, key, index) => ({ ...obj, [key]: this.value[index] }), {});
        }
    },
    mounted() {
        let select2Options = {
            allowClear: true,
            placeholder: '',
        };

        if (!this.inputOptions.items) {
            select2Options = {
                ...select2Options,
                ...{
                    tags: true,
                    createTag: (data) => {
                        return {
                            id: data.term,
                            text: data.term,
                            newTag: true,
                        };
                    },
                },
            };
        }

        $('#' + this.item.id).select2(select2Options);
    },
};
</script>

<template>
    <select :multiple="true" v-bind="$attrs" :name="item.name + '[]'">
        <option v-for="(selectItem, key) in items" :value="key" :selected="value.includes(key)">
            {{ selectItem }}
        </option>
    </select>
</template>
