<script setup>
import Value from '@/app/components/crud/particles/Value.vue';
</script>

<script>
export default {
    props: {
        relationItem: {
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
            page: this.booted.components.page,
            relations: this.relationItem.value,
            fields: this.relationItem.options.fields,
            itemGroups: {},
        };
    },
    created() {
        let model = this.page.model;

        for (let relationKey in this.relations) {
            this.itemGroups[relationKey] = model.prepareValues(this, this.fields, this.relations[relationKey]);
        }
    },
};
</script>

<template>
    <div v-for="(items, itemGroupKey) in itemGroups">
        <template v-for="(item, itemKey) in items">
            <template v-if="item.value !== undefined">
                <i>{{ item.label }}: </i>

                <Value :item="item" :id="id" />

                <br v-if="itemKey !== Object.keys(items).pop()">
            </template>
        </template>

        <hr v-if="itemGroupKey < Object.keys(itemGroups).length - 1">
    </div>
</template>