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
            value: this.item.value,
            options: this.item.options,
            inputOptions: this.item.options.select ?? {},
            items: {},
        };
    },
    created() {
        if (this.options.isMultiple) {
            this.value = this.item.value ? Object.values(this.item.value) : [];
        }

        if (this.inputOptions.items) {
            this.items = this.inputOptions.items;
        } else {
            if (this.options.isMultiple) {
                this.items = this.value.reduce((obj, key, index) => ({ ...obj, [key]: this.value[index] }), {});
            } else {
                this.items = this.value ? [this.value] : [];
            }
        }
    },
    mounted() {
        let select2Options = {
            allowClear: true,
            placeholder: this.$attrs.placeholder ?? '',
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

        $('#' + this.item.elementId)
            .select2(select2Options)
            .on('select2:open', () => {
                $('.select2-search__field[aria-controls="select2-' + this.item.elementId + '-results"]')
                    .get(0)
                    .focus();
            });
    },
};
</script>

<template>
    <select v-if="options.isMultiple" :multiple="true" v-bind="$attrs" style="width: 100%;">
        <option v-if="inputOptions.hasPrompt"></option>
        <option v-for="(selectItem, key) in items" :value="key" :selected="value.includes(key)">
            {{ selectItem }}
        </option>
    </select>

    <select v-else v-bind="$attrs" style="width: 100%;">
        <option v-if="inputOptions.hasPrompt"></option>
        <option v-for="(selectItem, key) in items" :value="key" :selected="key === value">
            {{ selectItem }}
        </option>
    </select>
</template>
