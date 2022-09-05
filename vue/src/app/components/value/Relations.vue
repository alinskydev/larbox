<script setup>
import Value from '@/app/components/Value.vue';
</script>

<script>
export default {
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
            model: this.booted.components.current.config.model,
            itemGroups: {},
        };
    },
    created() {
        for (let key in this.item.value) {
            this.itemGroups[key] = this.model.prepareValues(this, this.item.options.fields, this.item.value[key]);
        }
    },
};
</script>

<template>
    <template v-for="(items, itemGroupKey) in itemGroups">
        <div v-for="relationItem in items">
            <i>{{ relationItem.label }}: </i>
            <Value :item="relationItem" :id="id" />
        </div>

        <hr v-if="itemGroupKey < Object.keys(itemGroups).length - 1" />
    </template>
</template>
