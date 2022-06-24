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
            relations: this.relationItem.value,
            fields: this.relationItem.options.fields,
            itemGroups: [],
        };
    },
    created() {
        let itemGroups = [];

        for (let relationKey in this.relations) {
            let relation = this.relations[relationKey];

            itemGroups[relationKey] = {};

            for (let fieldKey in this.fields) {
                let field = this.fields[fieldKey],
                    value = field.value;

                value = value.replace(':locale', this.booted.locale);

                itemGroups[relationKey][fieldKey] = {
                    label: this.__('fields->' + fieldKey),
                    value: this.booted.helpers.iterator.searchByPath(relation, value),
                    type: field.type,
                    options: field.options ?? {},
                };

                if (itemGroups[relationKey][fieldKey].options.onComplete) {
                    itemGroups[relationKey][fieldKey].value = itemGroups[relationKey][fieldKey].options.onComplete(
                        this,
                        itemGroups[relationKey][fieldKey].value,
                    );
                }
            }
        }

        this.itemGroups = itemGroups;
    },
};
</script>

<template>
    <div v-for="(items, itemGroupKey) in itemGroups">
        <template v-for="(item, itemKey) in items">
            <template v-if="item.value !== undefined">
                <i>{{ item.label }}: </i>

                <Value :item="item" :id="id" />

                <template v-if="itemKey !== Object.keys(items).pop()">
                    <br>
                </template>
            </template>
        </template>

        <hr v-if="itemGroupKey < Object.keys(itemGroups).length - 1">
    </div>
</template>