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
            items: {},
        };
    },
    created() {
        this.items = this.item.value.reduce((obj, key, index) => ({ ...obj, [key]: this.item.value[index] }), {});
    },
    mounted() {
        $('#' + this.item.id).select2({
            allowClear: true,
            placeholder: '',
            tags: true,
            createTag: (data) => {
                return {
                    id: data.term,
                    text: this.__('Добавить') + ': ' + data.term,
                    newTag: true,
                };
            },
        });
    },
};
</script>

<template>
    <select :multiple="true" v-bind="$attrs" :name="item.name + '[]'">
        <option v-for="(selectItem, key) in items" :value="key" selected>
            {{ selectItem }}
        </option>
    </select>
</template>